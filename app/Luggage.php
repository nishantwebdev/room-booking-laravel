<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Luggage extends Model
{
  use SoftDeletes;
  protected $guarded = [];
}
