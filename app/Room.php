<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Room
 *
 * @package App
 * @property string $room_number
 * @property integer $floor
 * @property text $description
 */
class Room extends Model
{
    use SoftDeletes;

    protected $fillable = ['room_number', 'floor', 'description','category_id','building_id','address','size'];

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setFloorAttribute($input)
    {
        $this->attributes['floor'] = $input ? $input : null;
    }
    public function booking()
    {
        return $this->HasOne(Booking::class, 'room_id')->withTrashed();
    }
    public function building()
    {
        return $this->hasOne('App\Buildings', 'id', 'building_id')->withTrashed();
    }
}
