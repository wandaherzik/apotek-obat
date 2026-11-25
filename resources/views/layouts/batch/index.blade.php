@extends('layouts.app')

@section('title','Batch Obat')

@section('content')

<div class="app-content-header">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-6">

                <h3>Batch Obat</h3>

            </div>

            <div class="col-sm-6 text-end">

            </div>

        </div>

    </div>

</div>

<!--tabel-->
<div class="app-content">

<div class="container-fluid">

<div class="card">
            <div class="card-header">

                <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

                <i class="bi bi-plus-circle"></i>

                Tambah Data

                </button>

            </div>

<div class="card-body">

<table
id="datatable"
class="table table-bordered table-striped">

<thead>

<tr>

<th>No</th>

<th>Obat</th>

<th>No Batch</th>

<th>Tanggal Masuk</th>

<th>Expired</th>

<th>Harga Beli</th>

<th>Stok Masuk</th>

<th>Stok Sisa</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($batch as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->obat->nama_obat }}</td>

<td>{{ $item->nomor_batch }}</td>

<td>{{ $item->tanggal_masuk }}</td>

<td>{{ $item->tanggal_kadaluarsa }}</td>

<td>

Rp {{ number_format($item->harga_modal,0,',','.') }}

</td>

<td>

{{ $item->stok_awal }}

</td>

<td>

@if($item->stok_sisa==0)

<span class="badge bg-danger">

Habis

</span>

@else

<span class="badge bg-success">

{{ $item->stok_sisa }}

</span>

@endif

</td>
<td>

@php

    $today = \Carbon\Carbon::today();

    $expired = \Carbon\Carbon::parse($item->tanggal_kadaluarsa);

@endphp

@if($expired->isPast())

    <span class="badge bg-danger">

        Kadaluarsa

    </span>

@elseif($today->diffInMonths($expired,false) <= 6)

    <span class="badge bg-warning text-dark">

        Hampir Kadaluarsa

    </span>

@else

    <span class="badge bg-success">

        Aman

    </span>

@endif

</td>

<td>

<button
    class="btn btn-warning btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#modalEdit{{ $item->id_batch }}">

    <i class="bi bi-pencil"></i>

</button>

<form
action="{{ route('batch-obat.destroy',$item->id_batch) }}"
method="POST"
class="d-inline form-delete">

@csrf
@method('DELETE')

<button
class="btn btn-danger btn-sm">

<i class="bi bi-trash"></i>

</button>

</form>

</td>

</tr>
<div class="modal fade" id="modalEdit{{ $item->id_batch }}">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form action="{{ route('batch-obat.update',$item->id_batch) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5>Edit Batch Obat</h5>

                    <button class="btn-close"
                            data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">

                            <label>Obat</label>

                            <select name="id_obat"
                                    class="form-select">

                                @foreach($obat as $o)

                                <option
                                    value="{{ $o->id_obat }}"
                                    {{ $item->id_obat==$o->id_obat?'selected':'' }}>

                                    {{ $o->nama_obat }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label>Nomor Batch</label>

                            <input
                                type="text"
                                class="form-control"
                                name="nomor_batch"
                                value="{{ $item->nomor_batch }}"
                                readonly>

                        </div>

                        <div class="col-md-6 mt-3">

                            <label>Tanggal Masuk</label>

                            <input
                                type="date"
                                class="form-control"
                                name="tanggal_masuk"
                                value="{{ $item->tanggal_masuk }}">

                        </div>

                        <div class="col-md-6 mt-3">

                            <label>Tanggal Kadaluarsa</label>

                            <input
                                type="date"
                                class="form-control"
                                name="tanggal_kadaluarsa"
                                value="{{ $item->tanggal_kadaluarsa }}">

                        </div>

                        <div class="col-md-6 mt-3">

                            <label>Harga Modal</label>

                            <input
                                type="number"
                                class="form-control"
                                name="harga_modal"
                                value="{{ $item->harga_modal }}">

                        </div>

                        <div class="col-md-6 mt-3">

                            <label>Stok Awal</label>

                            <input
                                type="number"
                                class="form-control"
                                name="stok_awal"
                                value="{{ $item->stok_awal }}">

                        </div>

                        <div class="col-md-12 mt-3">

                            <label>Keterangan</label>

                            <textarea
                                name="keterangan"
                                class="form-control">{{ $item->keterangan }}</textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-success">

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>

<div
class="modal fade"
id="modalTambah">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form
action="{{ route('batch-obat.store') }}"
method="POST">

@csrf

<div class="modal-header">

<h5>Tambah Batch Obat</h5>

<button
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<div class="row">

<div class="col-md-6">

<label>Obat</label>

<select
name="id_obat"
class="form-select"
required>

<option value="">-- Pilih Obat --</option>

@foreach($obat as $o)

<option value="{{ $o->id_obat }}">

{{ $o->nama_obat }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6">

<label>No Batch</label>

<input
type="text"
name="nomor_batch"
class="form-control"
value="{{ $nomor_batch }}"
readonly>

</div>

<div class="col-md-6 mt-3">

<label>Tanggal Masuk</label>

<input
type="date"
name="tanggal_masuk"
class="form-control"
value="{{ date('Y-m-d') }}"
required>

</div>

<div class="col-md-6 mt-3">

<label>Tanggal Expired</label>

<input
type="date"
name="tanggal_kadaluarsa"
class="form-control"
required>

</div>

<div class="col-md-6 mt-3">

<label>Harga Beli</label>

<input
type="number"
name="harga_modal"
class="form-control"
required>

</div>

<div class="col-md-6 mt-3">

<label>Stok Masuk</label>

<input
type="number"
name="stok_awal"
class="form-control"
required>

</div>

<div class="col-md-12 mt-3">

</div>

</div>

</div>

<div class="modal-footer">

<button
class="btn btn-success">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

@endsection

@push('js')

<script>
if (!$.fn.DataTable.isDataTable('#datatable')) {
    new DataTable('#datatable',{
        language:{
            search:'Cari :',
            lengthMenu:'Tampilkan _MENU_ data',
            zeroRecords:'Data tidak ditemukan',
            info:'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            paginate:{
                previous:'Sebelumnya',
                next:'Selanjutnya'
            }
        }
    });
}

$('.form-delete').submit(function(e){
    e.preventDefault();
    let form = this;

    Swal.fire({
        title: 'Hapus data?',
        text: 'Data tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result)=>{
        if(result.isConfirmed){
            form.submit();
        }
    });
});
</script>

@endpush
