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
        Schema::create('layananantarunit', function (Blueprint $table) {
            $table->id('idlayanan');
            $table->string('namalayanan');
            $table->integer('iduser');
            $table->tinyInteger('status_tampil')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layananantarunit');
    }
};
