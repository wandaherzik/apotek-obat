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
Schema::create('batch_obat', function (Blueprint $table) {

    $table->id('id_batch');

    $table->foreignId('id_obat')
            ->constrained('obat','id_obat')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

    $table->string('nomor_batch');

    $table->date('tanggal_masuk');

    $table->date('tanggal_kadaluarsa');

    $table->integer('stok_awal');

    $table->integer('stok_sisa');

    $table->decimal('harga_modal',15,2);
    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_obat');
    }
};
