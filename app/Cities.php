<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
     protected $guarded = ['id'];
    protected $fillable = [
        'name','state_id'
    ];
}
