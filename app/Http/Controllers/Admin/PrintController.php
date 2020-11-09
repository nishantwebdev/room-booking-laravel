<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Countries;
use App\States;
use App\Cities;
use App\UserLog;
use App\TokenSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PrintController extends Controller
{

  public function edit(){
      $get = TokenSeries::where('id',1)->first();
      return view('admin.tokenseries.edit',compact('get'));
  }

  public function update(Request $request){

    $request->validate([
	        'name' => 'numeric|max:26'
	        ]);
    $update = TokenSeries::where('id',1)->update(['name' => $request->name]);

    if($update){
      return redirect('admin/token/edit');
    }

  }


}
