<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('administration_types', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->string('kode_layanan', 20)->unique();
            $table->text('deskripsi')->nullable();
            $table->text('persyaratan')->nullable();
            $table->integer('estimasi_hari')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administration_types');
    }
};
