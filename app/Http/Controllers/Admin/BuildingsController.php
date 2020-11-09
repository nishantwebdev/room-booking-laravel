<?php

namespace App\Http\Controllers\Admin;

use App\Buildings;
use App\Wings;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuildingsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (! Gate::allows('building_access')) {
        return abort(401);
    }


    if (request('show_deleted') == 1) {
        if (! Gate::allows('building_delete')) {
            return abort(401);
        }
        $buildings = Buildings::onlyTrashed()->get();
    } else {
        $buildings = Buildings::all();
    }

    return view('admin.buildings.index', compact('buildings'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    if (! Gate::allows('building_create')) {
        return abort(401);
    }
    $wings = Wings::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
    return view('admin.buildings.create',compact('wings'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    if (! Gate::allows('building_create')) {
        return abort(401);
    }
    $building = Buildings::create($request->except('_token'));



    return 1;

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Building  $building
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    if (! Gate::allows('building_view')) {
        return abort(401);
    }


    $building = Buildings::findOrFail($id);

    return view('admin.buildings.show', compact('building'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Building  $building
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    if (! Gate::allows('building_edit')) {
        return abort(401);
    }
    $building = Buildings::findOrFail($id);
    $wings = Wings::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

    return view('admin.buildings.edit', compact('building','wings'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Building  $building
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    if (! Gate::allows('building_edit')) {
        return abort(401);
    }
    $building = Buildings::findOrFail($id);
    $building->update($request->except('_token'));



    return redirect()->route('admin.buildings.index')->withMessage('Data Updated Successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Building  $building
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (! Gate::allows('building_delete')) {
        return abort(401);
    }
    $building = Buildings::findOrFail($id);
    $building->delete();

    return redirect()->route('admin.buildings.index')->withMessage('Data Deleted Successfully.');
  }

  /**
   * Delete all selected building at once.
   *
   * @param Request $request
   */
  public function massDestroy(Request $request)
  {
      if (! Gate::allows('building_delete')) {
          return abort(401);
      }
      if ($request->input('ids')) {
          $entries = Buildings::whereIn('id', $request->input('ids'))->get();

          foreach ($entries as $entry) {
              $entry->delete();
          }
      }

      return redirect()->route('admin.buildings.index')->withMessage('Data Deleted Successfully.');

  }


  /**
   * Restore building from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function restore($id)
  {
      if (! Gate::allows('building_delete')) {
          return abort(401);
      }
      $building = Buildings::onlyTrashed()->findOrFail($id);
      $building->restore();

      return redirect()->route('admin.buildings.index')->withMessage('Data Restored Successfully.');
  }

  /**
   * Permanently delete building from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function perma_del($id)
  {
      if (! Gate::allows('building_delete')) {
          return abort(401);
      }
      $building = Buildings::onlyTrashed()->findOrFail($id);
      $building->forceDelete();

      return redirect()->route('admin.buildings.index')->withMessage('Data Deleted Successfully.');
  }
}
