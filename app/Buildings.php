<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buildings extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function wing()
    {
        return $this->hasOne('App\Wings', 'id', 'wing_id')->withTrashed();
    }
    public function rooms()
    {
        return $this->hasMany('App\Room', 'building_id', 'id')->withDefault();
    }
}
