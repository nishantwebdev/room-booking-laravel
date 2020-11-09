<?php

namespace App\Http\Controllers\Admin;

use App\Wings;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (! Gate::allows('wing_access')) {
          return abort(401);
      }


      if (request('show_deleted') == 1) {
          if (! Gate::allows('wing_delete')) {
              return abort(401);
          }
          $wings = Wings::onlyTrashed()->get();
      } else {
          $wings = Wings::all();
      }

      return view('admin.wings.index', compact('wings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (! Gate::allows('wing_create')) {
          return abort(401);
      }
      return view('admin.wings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      if (! Gate::allows('wing_create')) {
          return abort(401);
      }
      $wing = Wings::create($request->except('_token'));



      return 1;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wing  $wing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if (! Gate::allows('wing_view')) {
          return abort(401);
      }


      $wing = Wings::findOrFail($id);

      return view('admin.wings.show', compact('wing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wing  $wing
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      if (! Gate::allows('wing_edit')) {
          return abort(401);
      }
      $wing = Wings::findOrFail($id);

      return view('admin.wings.edit', compact('wing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wing  $wing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (! Gate::allows('wing_edit')) {
          return abort(401);
      }
      $wing = Wings::findOrFail($id);
      $wing->update($request->except('_token'));



      return redirect()->route('admin.wings.index')->withMessage('Data Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wing  $wing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (! Gate::allows('wing_delete')) {
          return abort(401);
      }
      $wing = Wings::findOrFail($id);
      $wing->delete();

      return redirect()->route('admin.wings.index')->withMessage('Data Deleted Successfully.');
    }

    /**
     * Delete all selected wing at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('wing_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Wings::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->route('admin.wings.index')->withMessage('Data Deleted Successfully.');

    }


    /**
     * Restore wing from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('wing_delete')) {
            return abort(401);
        }
        $wing = Wings::onlyTrashed()->findOrFail($id);
        $wing->restore();

        return redirect()->route('admin.wings.index')->withMessage('Data Restored Successfully.');
    }

    /**
     * Permanently delete wing from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('wing_delete')) {
            return abort(401);
        }
        $wing = Wings::onlyTrashed()->findOrFail($id);
        $wing->forceDelete();

        return redirect()->route('admin.wings.index')->withMessage('Data Deleted Successfully.');
    }

}
