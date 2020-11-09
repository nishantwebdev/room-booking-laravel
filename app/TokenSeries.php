<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenSeries extends Model
{
  protected $fillable = ['name'];
  protected $table = 'token_series';
}
