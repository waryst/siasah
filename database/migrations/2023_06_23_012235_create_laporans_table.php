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
        Schema::create('laporans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('datasekolah_id');
            $table->string('nama');
            $table->string('tmp_lhr');
            $table->date('tgl_lhr');
            $table->string('orang_tua');
            $table->integer('nis');
            $table->string('no_ujian');
            $table->string('no_seri_ijazah');
            $table->string('tahun_pelajaran');
            $table->string('no_kepolisian');
            $table->date('tahun_kepolisian');
            $table->integer('status')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
