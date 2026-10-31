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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim', 20)->unique();
            $table->string('nama_mahasiswa', 100);
            $table->string('jenis_kelamin', 1);
            $table->unsignedInteger('prodi_id');
            $table->timestamps();

            $table->foreign('prodi_id')
                ->references('id')
                ->on('prodis')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};
