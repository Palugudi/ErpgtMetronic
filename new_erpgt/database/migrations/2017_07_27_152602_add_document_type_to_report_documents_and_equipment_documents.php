<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentTypeToReportDocumentsAndEquipmentDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_documents', function (Blueprint $table) {
            $table->string('document_type_id')->after('filename');
        });

        Schema::table('equipment_documents', function (Blueprint $table) {
            $table->string('document_type_id')->after('filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_documents', function (Blueprint $table) {
            $table->dropColumn('document_type_id');
        });

        Schema::table('equipment_documents', function (Blueprint $table) {
            $table->dropColumn('document_type_id');
        });
    }
}
