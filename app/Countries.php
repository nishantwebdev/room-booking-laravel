<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countries extends Model
{

  use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'name','sortname','phonecode'
    ];

    public function States()
    {
        return $this->belongsTo('App\States','country_id','id');
    }
}
