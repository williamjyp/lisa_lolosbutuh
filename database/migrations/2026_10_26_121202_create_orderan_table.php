<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orderan', function (Blueprint $table) {
            $table->id('no');
            $table->string('idorder');
            $table->dateTime('tglorder');
            $table->integer('idlayanan');
            $table->text('keluhan');
            $table->string('file_nama');
            $table->string('pemesan');
            $table->string('unit');
            $table->tinyInteger('status');
            $table->dateTime('tglstatus');
            $table->text('alasan');
            $table->text('catatan_internal');
            $table->string('file_hasil');
            $table->string('petugas');
            $table->tinyInteger('nilai');
            $table->text('komentar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderan');
    }
};
