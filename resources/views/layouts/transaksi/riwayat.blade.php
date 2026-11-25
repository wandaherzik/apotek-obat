@extends('layouts.app')

@section('title','Riwayat Transaksi')

@section('content')

<div class="app-content-header">

    <div class="container-fluid">

        <h3>Riwayat Transaksi</h3>

    </div>

</div>

<div class="app-content">

<div class="container-fluid">

<div class="card">

<div class="card-body">

<table
class="table table-bordered table-striped"
id="datatable">

<thead>

<tr>

<th>No</th>

<th>Kode</th>

<th>Tanggal</th>

<th>Pembeli</th>

<th>Kasir</th>

<th>Total</th>

<th>Metode</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($transaksi as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->kode_transaksi }}</td>

<td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y H:i') }}</td>

<td>{{ $item->nama_pembeli ?: '-' }}</td>

<td>{{ $item->user->nama }}</td>

<td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>

<td>

@if($item->metode_bayar=='CASH')

<span class="badge bg-success">

Cash

</span>

@elseif($item->metode_bayar=='QRIS')

<span class="badge bg-primary">

QRIS

</span>

@else

<span class="badge bg-warning">

Transfer

</span>

@endif

</td>

<td>

<a
href="{{ route('transaksi.show',$item->id_transaksi) }}"
class="btn btn-info btn-sm">

<i class="bi bi-eye"></i>

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>

@endsection