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
        Schema::create('lampirans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('laporan_id');
            $table->string('surat_laporan_polisi');
            $table->string('raport');
            $table->string('ijazah');
            $table->string('buku_induk');
            $table->string('akte');
            $table->string('permohonan_kepsek');
            $table->string('pernyataan_mutlak');
            $table->string('pernyataan_saksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampirans');
    }
};
