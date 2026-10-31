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
        Schema::create('matakuliahs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_mk', 20)->unique();
            $table->string('nama_mk', 100);
            $table->unsignedInteger('sks');
            $table->unsignedInteger('dosen_id');
            $table->timestamps();

            $table->foreign('dosen_id')
                ->references('id')
                ->on('dosens')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matakuliahs');
    }
};
