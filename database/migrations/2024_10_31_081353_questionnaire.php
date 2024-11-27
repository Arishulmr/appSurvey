<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id(); // This will create an `id` column as an unsignedBigInteger and auto-increment primary key
            $table->string('nama'); // Or $table->text('nama') if it needs to be longer
            $table->unsignedBigInteger('kategori_id'); // Remove `auto_increment` here
            $table->timestamps();

            // Foreign key constraint for kategori_id
            $table->foreign('kategori_id')
                ->references('id')
                ->on('kategori_survey')
                ->onDelete('cascade');
        });
    }
    /**php
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaires');
    }
};
