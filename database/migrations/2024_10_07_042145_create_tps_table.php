<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tps');
            $table->bigInteger('kelurahan_id');
            $table->bigInteger('kecamatan_id');
            $table->bigInteger('kabupaten_id');
            $table->bigInteger('jumlah_dpt')->nullable();
            $table->bigInteger('jumlah_surat_suara')->nullable();
            $table->bigInteger('jml_surat_suara_sah')->nullable();
            $table->bigInteger('jml_surat_suara_tidak_sah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tps');
    }
};
