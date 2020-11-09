<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('user_logs')) {
          Schema::create('user_logs', function (Blueprint $table) {
              $table->increments('id');

              $table->integer('created_by')->nullable();
              $table->integer('customer_id')->nullable();
              $table->string('log_type')->nullable();
              $table->text('description')->nullable();

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
        Schema::dropIfExists('user_logs');
    }
}
