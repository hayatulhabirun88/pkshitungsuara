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
        Schema::create('saksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('status');
            $table->string('kode_register')->nullable();
            $table->string('tps_id');
            $table->bigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saksis');
    }
};
