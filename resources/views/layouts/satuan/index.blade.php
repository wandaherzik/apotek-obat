@extends('layouts.app')

@section('title','Satuan Obat')

@section('content')

<div class="app-content-header">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-6">
                <h3>Satuan Obat</h3>
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

                Tambah Data

                </button>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped"
                    id="datatable">

                    <thead>

                        <tr>

                        <th>No</th>

                        <th>Nama Satuan</th>

                        <th>Keterangan</th>

                        <th width="150">Aksi</th>

                        </tr>

                    </thead>

                     <tbody>

                        @foreach($satuan as $item)

                        <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->nama_satuan }}</td>

                        <td>{{ $item->keterangan }}</td>
                        </td>

 <td>

    <button
        class="btn btn-warning btn-sm btn-edit"
        data-id="{{ $item->id_satuan }}"
        data-nama="{{ $item->nama_satuan }}"
        data-keterangan="{{ $item->keterangan }}">

        <i class="bi bi-pencil-square"></i>

    </button>

    <form action="{{ route('satuan.destroy',$item->id_satuan) }}"
          method="POST"
          class="d-inline form-delete">

        @csrf
        @method('DELETE')

        <button class="btn btn-danger btn-sm">

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

<!--Modal Tambah-->
<div class="modal fade" id="modalTambah" tabindex="-1">

    <div class="modal-dialog">

        <form action="{{ route('satuan.store') }}"
              method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Tambah Satuan

                    </h5>

                    <button
                    class="btn-close"
                    data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Satuan

                        </label>

                        <input
                        type="text"
                        name="nama_satuan"
                        class="form-control"
                        required>

                    </div>

                    <div class="mb-3">

                        <label>Keterangan</label>

                        <textarea
                        name="keterangan"
                        class="form-control"
                        rows="3"
                        placeholder="Masukkan keterangan satuan"></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                    class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!--Modal Edit-->
<div class="modal fade" id="modalEdit">

    <div class="modal-dialog">

        <form
            id="formEdit"
            method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">

                    <h5>Edit Satuan</h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Nama Satuan</label>

                        <input
                            type="text"
                            id="editNama"
                            name="nama_satuan"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Keterangan</label>

                        <textarea
                            id="editKeterangan"
                            name="keterangan"
                            class="form-control"></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-primary">

                        Update

                    </button>

                </div>

            </div>

        </form>

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

document.querySelectorAll('.btn-edit').forEach(button=>{

    button.addEventListener('click',function(){

        let id=this.dataset.id;

        document.getElementById('editNama').value=this.dataset.nama;

        document.getElementById('editKeterangan').value=this.dataset.keterangan;

        document.getElementById('formEdit').action="/satuan/"+id;

        new bootstrap.Modal(document.getElementById('modalEdit')).show();

    });

});
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