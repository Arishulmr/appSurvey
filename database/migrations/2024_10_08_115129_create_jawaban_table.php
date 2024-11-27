<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orang_id')->nullable();
            $table->unsignedBigInteger('masukan_id')->nullable();
            $table->text('jawaban')->nullable();
            $table->timestamp('selesai_pada')->default(now());

            // $table->foreign('orang_id')->references('id')->on('orang')->onDelete('cascade');
            // $table->foreign('masukan_id')->references('id')->on('masukan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban');
    }
}