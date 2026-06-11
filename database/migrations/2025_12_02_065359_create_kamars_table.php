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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->enum('tipe', ['AC', 'Non-AC'])->default('Non-AC');
            $table->json('foto_kamar')->nullable();
            $table->integer('lantai');
            $table->decimal('harga_bulanan', 10, 2);
            $table->enum('listrik', ['Token', 'Include'])->default('Include');
            $table->enum('status', ['Kosong', 'Terisi', 'Perbaikan'])->default('Kosong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
