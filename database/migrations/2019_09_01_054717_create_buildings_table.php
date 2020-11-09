<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('buildings')) {
          Schema::create('buildings', function (Blueprint $table) {
              $table->increments('id');

              $table->string('name')->nullable();
              $table->integer('wing_id')->nullable();
              $table->text('address')->nullable();

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
        Schema::dropIfExists('buildings');
    }
}
