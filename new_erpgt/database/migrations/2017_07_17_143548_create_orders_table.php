<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id');
            $table->integer('equipment_type_id');
            $table->integer('status_id');
            $table->integer('quantity');
            $table->string('reference');
            $table->integer('brand_id');
            $table->string('model');
            $table->text('comment')->nullable();
            $table->integer('equipment_id');
            $table->integer('localisation_id')->nullable();
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
