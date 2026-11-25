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
Schema::create('obat', function (Blueprint $table) {

    $table->id('id_obat');

    $table->string('kode_obat',20)->unique();

    $table->string('barcode',100)->nullable()->unique();

    $table->string('nama_obat',150);

    $table->unsignedBigInteger('id_kategori');

    $table->unsignedBigInteger('id_satuan');

    $table->decimal('harga_jual',12,2);

    $table->integer('stok_minimum')->default(0);

    $table->boolean('status')->default(true);

    $table->text('keterangan')->nullable();

    $table->timestamps();

    $table->foreign('id_kategori')
        ->references('id_kategori')
        ->on('kategori_obat')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

    $table->foreign('id_satuan')
        ->references('id_satuan')
        ->on('satuans')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
