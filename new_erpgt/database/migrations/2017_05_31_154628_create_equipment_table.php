<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('map_id');
            $table->integer('site_id');
            $table->integer('domain_id');
            $table->integer('equipment_type_id');
            $table->string('equipment_name');
            $table->integer('brand_id');
            $table->string('model');
            $table->integer('quantity');
            $table->integer('status_id');
            $table->integer('localisation_id');
            $table->string('serial_number');
            $table->longtext('informations');
            $table->string('manufacture_date');
            $table->string('JLL_reference');
            $table->float('position_left');
            $table->float('position_top');
            $table->string('picture');
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
        Schema::dropIfExists('equipment');
    }
}
