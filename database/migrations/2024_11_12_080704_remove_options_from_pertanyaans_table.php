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
        Schema::table('pertanyaans', function (Blueprint $table) {
            $table->dropColumn('options');
        });
    }

    public function down()
    {
        Schema::table('pertanyaans', function (Blueprint $table) {
            $table->text('options')->nullable(); // If you want to revert the change
        });
    }

};
