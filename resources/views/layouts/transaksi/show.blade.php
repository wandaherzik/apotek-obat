@extends('layouts.app')

@section('title','Detail Transaksi')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">

        <div class="d-flex justify-content-between">

            <h3>Detail Transaksi</h3>

        </div>

    </div>
</div>

<div class="app-content">

<div class="container-fluid">

<div class="card">

<div class="card-body">

<div class="row">

<div class="col-md-6">

<b>Kode Transaksi</b><br>

{{ $transaksi->kode_transaksi }}

</div>

<div class="col-md-6">

<b>Tanggal</b><br>

{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y H:i') }}

</div>

<div class="col-md-6 mt-3">

<b>Pembeli</b><br>

{{ $transaksi->nama_pembeli ?: '-' }}

</div>

<div class="col-md-6 mt-3">

<b>Kasir</b><br>

{{ $transaksi->user->nama }}

</div>

</div>

<hr>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>Obat</th>

<th>Batch</th>

<th>Qty</th>

<th>Harga</th>

<th>Subtotal</th>

</tr>

</thead>

<tbody>

@foreach($transaksi->detail as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->batch->obat->nama_obat }}</td>

<td>{{ $item->batch->nomor_batch }}</td>

<td>{{ $item->jumlah }}</td>

<td>
Rp {{ number_format($item->harga_jual,0,',','.') }}
</td>

<td>
Rp {{ number_format($item->subtotal,0,',','.') }}
</td>

</tr>

@endforeach

</tbody>

<tfoot>

<tr>

<th colspan="5" class="text-end">

TOTAL

</th>

<th>

Rp {{ number_format($transaksi->total_harga,0,',','.') }}

</th>

</tr>

<tr>

<th colspan="5" class="text-end">

Bayar

</th>

<th>

Rp {{ number_format($transaksi->total_bayar,0,',','.') }}

</th>

</tr>

<tr>

<th colspan="5" class="text-end">

Kembalian

</th>

<th>

Rp {{ number_format($transaksi->kembalian,0,',','.') }}

</th>

</tr>

</tfoot>

</table>

</div>

</div>

</div>

</div>

@endsection