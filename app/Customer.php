<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 *
 * @package App
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $country
*/

class Customer extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCountryIdAttribute($input)
    {
        $this->attributes['country_id'] = $input ? $input : null;
    }

    public function country()
    {
        return $this->belongsTo(\App\Countries::class, 'country_id')->withTrashed();
    }
    public function state()
    {
        return $this->belongsTo('App\States','state_id','id');
    }
    public function city()
    {
        return $this->belongsTo('App\Cities','city_id','id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullNameWithMobileAttribute()
    {
        return $this->first_name . ' ' . $this->last_name. ' - ' . $this->phone ;
    }

    public function getFullNameWithMobileAndIdAttribute()
    {
        return $this->first_name . ' ' . $this->last_name. ' - ' . $this->phone .' - '.$this->id;
    }

}
