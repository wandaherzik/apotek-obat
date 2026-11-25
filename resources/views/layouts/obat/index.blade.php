@extends('layouts.app')

@section('title','Master Obat')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3>Data Obat</h3>
            </div>
        </div>
    </div>
</div>

<div class="app-content">

<div class="container-fluid">

<div class="card">
                <div class="card-header">

                <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

                <i class="bi bi-plus-circle"></i>

                Tambah Obat

                </button>

            </div>

<div class="card-body">

<!--tabel-->

<table
class="table table-bordered table-striped"
id="datatable">

<thead>

<tr>

<th>No</th>
<th>Kode</th>
<th>Barcode</th>
<th>Nama Obat</th>
<th>Kategori</th>
<th>Satuan</th>
<th>Harga Jual</th>
<th>Stok Minimum</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($obat as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->kode_obat }}</td>

<td>{{ $item->barcode }}</td>

<td>{{ $item->nama_obat }}</td>

<td>{{ $item->kategori->nama_kategori }}</td>

<td>{{ $item->satuan->nama_satuan }}</td>

<td>Rp {{ number_format($item->harga_jual,0,',','.') }}</td>

<td>{{ $item->stok_minimum }}</td>

<td>

<button
type="button"
class="btn btn-warning btn-sm btn-edit"

data-id="{{ $item->id_obat }}"
data-kode="{{ $item->kode_obat }}"
data-barcode="{{ $item->barcode }}"
data-nama="{{ $item->nama_obat }}"
data-kategori="{{ $item->id_kategori }}"
data-satuan="{{ $item->id_satuan }}"
data-harga="{{ $item->harga_jual }}"
data-minimum="{{ $item->stok_minimum }}"
data-keterangan="{{ $item->keterangan }}"
data-status="{{ $item->status }}">

<i class="bi bi-pencil"></i>

</button>

<form
action="{{ route('obat.destroy',$item->id_obat) }}"
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

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>

<!-- Modal tambah-->
 <div class="modal fade"
id="modalTambah">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form
action="{{ route('obat.store') }}"
method="POST">

@csrf

<div class="modal-header">

<h5>Tambah Obat</h5>

<button
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<div class="row">

<div class="col-md-6">

<label>Kode Obat</label>

<input
type="text"
name="kode_obat"
class="form-control"
value="{{ $kode_obat }}"
readonly>

</div>

<div class="col-md-6">

<label>Barcode</label>

<input
type="text"
name="barcode"
class="form-control">

</div>

<div class="col-md-12 mt-3">

<label>Nama Obat</label>

<input
type="text"
name="nama_obat"
class="form-control"
required>

</div>

<div class="col-md-6 mt-3">

<label>Kategori</label>

<select
name="id_kategori"
class="form-select">

@foreach($kategori as $k)

<option
value="{{ $k->id_kategori }}">

{{ $k->nama_kategori }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mt-3">

<label>Satuan</label>

<select
name="id_satuan"
class="form-select">

@foreach($satuan as $s)

<option
value="{{ $s->id_satuan }}">

{{ $s->nama_satuan }}

</option>

@endforeach

</select>

</div>

<div class="col-md-4 mt-3">

<label>Harga Jual</label>

<input
type="number"
name="harga_jual"
class="form-control"
required>

</div>

<div class="col-md-4 mt-3">

<label>Stok Minimum</label>

<input
type="number"
name="stok_minimum"
class="form-control"
value="0">

</div>

<div class="col-md-12 mt-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"></textarea>

</div>

<div class="col-md-12 mt-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="1">Aktif</option>

<option value="0">Nonaktif</option>

</select>

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

<div class="modal fade" id="modalEdit">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form
id="formEdit"
method="POST">

@csrf
@method('PUT')

<div class="modal-header">

<h5>Edit Obat</h5>

<button
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<div class="row">

<div class="col-md-6">

<label>Kode Obat</label>

<input
type="text"
id="editKode"
name="kode_obat"
class="form-control"
readonly>

</div>

<div class="col-md-6">

<label>Barcode</label>

<input
type="text"
id="editBarcode"
name="barcode"
class="form-control">

</div>

<div class="col-md-12 mt-3">

<label>Nama Obat</label>

<input
type="text"
id="editNama"
name="nama_obat"
class="form-control">

</div>

<div class="col-md-6 mt-3">

<label>Kategori</label>

<select
id="editKategori"
name="id_kategori"
class="form-select">

@foreach($kategori as $k)

<option value="{{ $k->id_kategori }}">

{{ $k->nama_kategori }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mt-3">

<label>Satuan</label>

<select
id="editSatuan"
name="id_satuan"
class="form-select">

@foreach($satuan as $s)

<option value="{{ $s->id_satuan }}">

{{ $s->nama_satuan }}

</option>

@endforeach

</select>

</div>

<div class="col-md-4 mt-3">

<label>Harga Jual</label>

<input
type="number"
id="editHarga"
name="harga_jual"
class="form-control">

</div>

<div class="col-md-4 mt-3">

<label>Stok Minimum</label>

<input
type="number"
id="editMinimum"
name="stok_minimum"
class="form-control">

</div>

<div class="col-md-12 mt-3">

<label>Keterangan</label>

<textarea
id="editKeterangan"
name="keterangan"
class="form-control"></textarea>

</div>

<div class="col-md-12 mt-3">

<label>Status</label>

<select
id="editStatus"
name="status"
class="form-select">

<option value="1">Aktif</option>

<option value="0">Nonaktif</option>

</select>

</div>

</div>

</div>

<div class="modal-footer">

<button
class="btn btn-success">

Update

</button>

</div>

</form>

</div>

</div>

</div>

<!--modal datatables-->
@endsection
@push('js')

<script>

document.querySelectorAll('.btn-edit').forEach(button=>{

    button.addEventListener('click',function(){

        let id=this.dataset.id;

        document.getElementById('editKode').value=this.dataset.kode;

        document.getElementById('editBarcode').value=this.dataset.barcode;

        document.getElementById('editNama').value=this.dataset.nama;

        document.getElementById('editKategori').value=this.dataset.kategori;

        document.getElementById('editSatuan').value=this.dataset.satuan;

        document.getElementById('editHarga').value=this.dataset.harga;

        document.getElementById('editMinimum').value=this.dataset.minimum;

        document.getElementById('editKeterangan').value=this.dataset.keterangan;

        document.getElementById('editStatus').value=this.dataset.status;

        document.getElementById('formEdit').action="/obat/"+id;

        new bootstrap.Modal(
            document.getElementById('modalEdit')
        ).show();

    });

});

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

</script>

@endpush

@push('js')
<script>
$('.form-delete').submit(function(e){

    e.preventDefault();

    let form=this;

    Swal.fire({

        title:'Hapus data?',

        text:'Data tidak dapat dikembalikan.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonText:'Ya',

        cancelButtonText:'Batal'

    }).then((result)=>{

        if(result.isConfirmed){

            form.submit();

        }

    });

});
</script>
@endpush