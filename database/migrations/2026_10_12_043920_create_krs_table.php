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
        Schema::create('krs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('matakuliah_id');
            $table->string('semester', 10);
            $table->string('tahun_ajaran', 9);
            $table->timestamps();

            $table->foreign('mahasiswa_id')
                ->references('id')
                ->on('mahasiswas')
                ->onDelete('cascade');

            $table->foreign('matakuliah_id')
                ->references('id')
                ->on('matakuliahs')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('krs');
    }
};
