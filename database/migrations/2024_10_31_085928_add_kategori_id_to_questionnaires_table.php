<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoriIdToQuestionnairesTable extends Migration
{
    public function up()
    {
        Schema::table('pertanyaan', function (Blueprint $table) {
            // Add foreign key constraint for kategori_id
            $table->foreign('questionnaire_id')
                ->references('id')
                ->on('questionnaires')
                ->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('questionnaires', function (Blueprint $table) {
            // Drop the column if rolling back
            $table->dropColumn('kategori_id');
        });
    }
}