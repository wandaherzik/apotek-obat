@extends('layouts.app')

@section('title','Laporan Penjualan')

@section('content')

<div class="app-content-header">

<div class="container-fluid">

<h3>

Laporan Penjualan

</h3>

</div>

</div>

<div class="app-content">

<div class="container-fluid">

<form method="GET">

<div class="row">

<div class="col-md-3">

<label>Tanggal Awal</label>

<input
type="date"
name="tanggal_awal"
value="{{ request('tanggal_awal') }}"
class="form-control">

</div>

<div class="col-md-3">

<label>Tanggal Akhir</label>

<input
type="date"
name="tanggal_akhir"
value="{{ request('tanggal_akhir') }}"
class="form-control">

</div>

<div class="col-md-2">

<label>&nbsp;</label>

<button
class="btn btn-primary w-100">

Tampilkan

</button>

</div>

</div>

</form>

<hr>

<div class="row">

<div class="col-md-4">

<div class="small-box text-bg-primary">

<div class="inner">

<h3>

{{ $transaksi->count() }}

</h3>

<p>

Total Transaksi

</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="small-box text-bg-success">

<div class="inner">

<h3>

Rp {{ number_format($totalPenjualan,0,',','.') }}

</h3>

<p>

Total Penjualan

</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="small-box text-bg-warning">

<div class="inner">

<h3>

Rp {{ number_format($totalKeuntungan,0,',','.') }}

</h3>

<p>

Total Keuntungan

</p>

</div>

</div>


</div>


</div>

<a
href="{{ route('laporan.penjualan.pdf',request()->query()) }}"
class="btn btn-danger">

<i class="bi bi-file-earmark-pdf"></i>

Export PDF

</a>
<br>
<br>
<table class="table table-bordered table-striped">

<thead>

<tr>

<th>No</th>

<th>Kode</th>

<th>Tanggal</th>

<th>Pembeli</th>

<th>Kasir</th>

<th>Total</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@forelse($transaksi as $item)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td>

{{ $item->kode_transaksi }}

</td>

<td>

{{ $item->tanggal_transaksi }}

</td>

<td>

{{ $item->nama_pembeli }}

</td>

<td>

{{ $item->user->nama }}

</td>

<td>

Rp {{ number_format($item->total_harga,0,',','.') }}

</td>

<td>

<a
href="{{ route('transaksi.show',$item->id_transaksi) }}"
class="btn btn-info btn-sm">

Detail

</a>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center">

Tidak ada data.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

@endsection