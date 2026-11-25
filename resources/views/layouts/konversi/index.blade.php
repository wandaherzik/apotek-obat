@extends('layouts.app')

@section('title','Konversi Satuan')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3>Konversi Satuan</h3>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                <i class="bi bi-plus-circle"></i>
                Tambah Konversi
            </button>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Satuan Asal</th>
                        <th>Jumlah</th>
                        <th>Satuan Tujuan</th>
                        <th>Keterangan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konversi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->satuanAsal->nama_satuan }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->satuanTujuan->nama_satuan }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>

                            <button class="btn btn-warning btn-sm btn-edit"
                                    data-id="{{ $item->id_konversi }}"
                                    data-asal="{{ $item->id_satuan_asal }}"
                                    data-jumlah="{{ $item->jumlah }}"
                                    data-tujuan="{{ $item->id_satuan_tujuan }}"
                                    data-keterangan="{{ $item->keterangan }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <form action="{{ route('konversi-satuan.destroy',$item->id_konversi) }}"
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

{{-- Modal Tambah --}}

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('konversi-satuan.store') }}" method="POST">
            @csrf

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Konversi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Satuan Asal</label>
                    <select name="id_satuan_asal" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach($satuan as $s)
                            <option value="{{ $s->id_satuan }}">
                                {{ $s->nama_satuan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           min="1"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Satuan Tujuan</label>
                    <select name="id_satuan_tujuan" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach($satuan as $s)
                            <option value="{{ $s->id_satuan }}">
                                {{ $s->nama_satuan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>

        </div>
    </form>
</div>


</div>
<div class="modal fade" id="modalEdit" tabindex="-1">

    <div class="modal-dialog">

        <form
            id="formEdit"
            method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Edit Konversi

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Satuan Asal</label>

                        <select
                            id="editAsal"
                            name="id_satuan_asal"
                            class="form-select"
                            required>

                            @foreach($satuan as $s)

                                <option value="{{ $s->id_satuan }}">

                                    {{ $s->nama_satuan }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Jumlah</label>

                        <input
                            type="number"
                            id="editJumlah"
                            name="jumlah"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Satuan Tujuan</label>

                        <select
                            id="editTujuan"
                            name="id_satuan_tujuan"
                            class="form-select"
                            required>

                            @foreach($satuan as $s)

                                <option value="{{ $s->id_satuan }}">

                                    {{ $s->nama_satuan }}

                                </option>

                            @endforeach

                        </select>

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
                        class="btn btn-success">

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
    document.querySelectorAll('.btn-edit').forEach(button=>{

    button.addEventListener('click',function(){

        let id=this.dataset.id;

        document.getElementById('editAsal').value=this.dataset.asal;

        document.getElementById('editJumlah').value=this.dataset.jumlah;

        document.getElementById('editTujuan').value=this.dataset.tujuan;

        document.getElementById('editKeterangan').value=this.dataset.keterangan;

        document.getElementById('formEdit').action="/konversi-satuan/"+id;

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
