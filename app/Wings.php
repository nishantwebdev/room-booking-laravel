<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wings extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function buildings()
    {
        return $this->hasMany('App\Buildings', 'wing_id', 'id')->withDefault();
    }
}
