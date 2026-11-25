<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konversi_satuan', function (Blueprint $table) {

            $table->id('id_konversi');

            $table->unsignedBigInteger('id_satuan_asal');

            $table->integer('jumlah');

            $table->unsignedBigInteger('id_satuan_tujuan');

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->foreign('id_satuan_asal')
                ->references('id_satuan')
                ->on('satuans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('id_satuan_tujuan')
                ->references('id_satuan')
                ->on('satuans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konversi_satuan');
    }
};