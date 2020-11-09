<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Ctegory;
use App\Category;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use App\Http\Requests\Admin\StoreCategoriesRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        //show template
        return view('admin.categories.create');
    }

    public function store(StoreCategoriesRequest $request)
    {
        if (! Gate::allows('category_create')) {
            return abort(401);
        }

        $category = Category::create([
            'name'=> $request->name
        ]);

        if ($request->hasFile('image')) {
          $image = $request->file('image');
          $imagedetails = getimagesize($image);
          $filename = uniqid()."_".$category->id . '.' . $image->getClientOriginalExtension();

          if($imagedetails[0] > 600){

            $img = Image::make($image->getRealPath())->resize(600, null, function ($constraint) {
          $constraint->aspectRatio();
          });

          }else{

            $img = Image::make($image->getRealPath())->resize($imagedetails[0], null, function ($constraint) {
          $constraint->aspectRatio();
          });

          }
          $img->save(base_path('public/images/category/' .$filename));

            $category->image =  $filename;
            $category->save();
        }
        return redirect('/admin/categories');

    }

    /**
     * Show the form for editing category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update category in storage.
     *
     * @param  \App\Http\Requests\UpdateCountriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $id)
    {
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);
        $category->update($request->all());


        if ($request->hasFile('image')) {
          $image = $request->file('image');
          $imagedetails = getimagesize($image);
          $filename = uniqid()."_".$category->id . '.' . $image->getClientOriginalExtension();

          if($imagedetails[0] > 600){

            $img = Image::make($image->getRealPath())->resize(600, null, function ($constraint) {
          $constraint->aspectRatio();
          });

          }else{

            $img = Image::make($image->getRealPath())->resize($imagedetails[0], null, function ($constraint) {
          $constraint->aspectRatio();
          });

          }
          $img->save(base_path('public/images/category/' .$filename));

            $category->image =  $filename;
            $category->save();
        }



        return redirect()->route('admin.categories.index');
    }


    /**
     * Remove Booking from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('category_delete')) {
            return abort(401);
        }
        $booking = Category::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Category::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        $booking = Category::onlyTrashed()->findOrFail($id);
        $booking->restore();

        return redirect()->route('admin.bookings.index');
    }

    /**
     * Permanently delete Category from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('booking_delete')) {
            return abort(401);
        }
        $booking = Category::onlyTrashed()->findOrFail($id);
        $booking->forceDelete();

        return redirect()->route('admin.bookings.index');
    }


}
