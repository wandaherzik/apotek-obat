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
    Schema::create('transaksi', function (Blueprint $table) {

        $table->id('id_transaksi');

        $table->string('kode_transaksi',30)->unique();

        $table->dateTime('tanggal_transaksi');

        $table->string('nama_pembeli',100)->nullable();

        $table->foreignId('id_user')
                ->constrained('users','id_user')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

        $table->decimal('total_harga',15,2);

        $table->enum('metode_bayar',[
            'CASH',
            'QRIS',
            'TRANSFER'
        ]);

        $table->decimal('total_bayar',15,2)->default(0);

        $table->decimal('kembalian',15,2)->default(0);

        $table->text('keterangan')->nullable();

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
