<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('intern_contact');
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_postal_code')->nullable();
            $table->string('company_city')->nullable();
            $table->string('intervention_domain')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['intern_contact', 'company_name', 'company_address', 'company_postal_code', 'company_city' , 'intervention_domain']);
        });
    }
}
