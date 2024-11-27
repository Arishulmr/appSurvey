<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertanyaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan')->nullable();
            $table->enum('tipe_pertanyaan', ['pilihan ganda', 'teks', 'nilai'])->nullable();
            $table->unsignedBigInteger('questionnaire_id'); // Match type with `questionnaires` table

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('questionnaire_id')
                ->references('id')
                ->on('questionnaires')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertanyaan');
    }
}
