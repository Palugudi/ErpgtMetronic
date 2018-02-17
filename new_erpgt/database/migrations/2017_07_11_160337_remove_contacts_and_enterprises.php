<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveContactsAndEnterprises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('enterprises');
        Schema::dropIfExists('contacts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('enterprises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id');
            $table->string('company');
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('activity_domain')->nullable();
            $table->string('address')->nullable();
            $table->integer('postal_code')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job')->nullable();
            $table->string('email')->nullable();
            $table->string('number')->nullable();
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
        });
    }
}
