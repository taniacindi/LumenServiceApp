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
        Schema::create('dosens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nidn', 20)->unique();
            $table->string('nama_dosen', 100);
            $table->string('email', 100)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosens');
    }
};
