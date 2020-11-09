<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrScanLog extends Model
{
    protected $table ="qr_scan_log";

    protected $fillable =['scaner_id','customer_id','type','message'];
}
