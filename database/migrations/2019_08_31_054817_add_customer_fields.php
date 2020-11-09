<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('customers', function(Blueprint $table) {
          $table->integer('state_id')->nullable();
          $table->integer('city_id')->nullable();
          $table->string('village')->nullable();
          $table->string('image')->nullable();
          $table->string('phone2')->nullable();
          $table->string('qr_code')->nullable();
          $table->string('email')->nullable()->change();

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
