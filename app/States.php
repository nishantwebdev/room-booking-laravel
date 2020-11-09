<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
     protected $guarded = ['id'];
    protected $fillable = [
        'name','country_id'
    ];
    
    
    public function Cities()
    {
        return $this->belongsTo('App\Cities','state_id','id');
    }
    
}
