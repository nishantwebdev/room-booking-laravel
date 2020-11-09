<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckinFieldsToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('bookings', function(Blueprint $table) {
          $table->string('is_check_in')->nullable();
          $table->string('is_check_out')->nullable();
          $table->integer('created_by')->nullable();
          $table->integer('updated_by')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
