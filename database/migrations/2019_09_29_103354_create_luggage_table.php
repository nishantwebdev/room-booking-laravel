<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLuggageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(! Schema::hasTable('luggage')) {
          Schema::create('luggage', function (Blueprint $table) {
              $table->increments('id');

              $table->integer('created_by')->nullable();
              $table->integer('updated_by')->nullable();
              $table->integer('customer_id')->nullable();
              $table->string('type')->nullable();
              $table->integer('bags_in')->default(0);
              $table->integer('bags_out')->default(0);

              $table->timestamps();
              $table->softDeletes();
              $table->index(['deleted_at']);
          });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('luggage');
    }
}
