@extends('layouts.app')

@section('title','Restok')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3>Data Restok</h3>
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
                                    data-bs-target="#modalRestok">

                                    <i class="bi bi-plus-circle"></i>
                                    Restok

                                </button>

                        </div>

        <div class="card-body">
                        <table
                            class="table table-bordered table-striped"
                            id="datatable">

                            <thead>

                            <tr>

                            <th>No</th>

                            <th>No Batch</th>

                            <th>Obat</th>

                            <th>Jumlah</th>

                            <th>Stok Sebelum</th>

                            <th>Stok Sesudah</th>

                            <th>Tanggal</th>

                            <th>Keterangan</th>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($log as $item)

                            <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->batch->nomor_batch }}</td>

                            <td>{{ $item->batch->obat->nama_obat }}</td>

                            <td>{{ $item->jumlah }}</td>

                            <td>{{ $item->stok_sebelum }}</td>

                            <td>{{ $item->stok_sesudah }}</td>

                            <td>{{ $item->created_at->format('d-m-Y') }}</td>

                            <td>{{ $item->keterangan }}</td>

                            </tr>

                            @endforeach

                            </tbody>

                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                                    <div class="modal fade" id="modalRestok" tabindex="-1">

                                <div class="modal-dialog modal-lg">

                                    <div class="modal-content">

                                        <form action="{{ route('restok.store') }}" method="POST">

                                            @csrf

                                            <div class="modal-header">

                                                <h5 class="modal-title">
                                                    <i class="bi bi-box-seam"></i>
                                                    Restok Obat
                                                </h5>

                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal">
                                                </button>

                                            </div>

                                            <div class="modal-body">

                                                <div class="row">

                                                    <div class="col-md-12">

                                                        <label class="form-label">
                                                            Batch Obat
                                                        </label>

                                                        <select
                                                            name="id_batch"
                                                            id="batchSelect"
                                                            class="form-select"
                                                            required>

                                                            <option value="">-- Pilih Batch --</option>

                                                            @foreach($batch as $b)

                                                                <option
                                                                    value="{{ $b->id_batch }}"
                                                                    data-harga="{{ $b->harga_modal }}">

                                                                    {{ $b->nomor_batch }}
                                                                    |
                                                                    {{ $b->obat->nama_obat }}
                                                                    |
                                                                    Exp:
                                                                    {{ \Carbon\Carbon::parse($b->tanggal_kadaluarsa)->format('d-m-Y') }}
                                                                    |
                                                                    Stok:
                                                                    {{ $b->stok_sisa }}
                                                                    |                                                                  |
                                                                    harga modal:
                                                                    {{ $b->harga_modal }}

                                                                </option>

                                                            @endforeach

                                                        </select>

                                                    </div>

                                                    <div class="col-md-6 mt-3">

                                                        <label class="form-label">
                                                            Harga Modal
                                                        </label>

                                                        <input
                                                            type="text"
                                                            id="hargaModal"
                                                            class="form-control"
                                                            readonly>

                                                    </div>

                                                    <div class="col-md-6 mt-3">

                                                        <label class="form-label">
                                                            Jumlah Restok
                                                        </label>

                                                        <input
                                                            type="number"
                                                            name="jumlah"
                                                            class="form-control"
                                                            min="1"
                                                            placeholder="Masukkan jumlah restok"
                                                            required>

                                                    </div>

                                                    <div class="col-md-12 mt-3">

                                                        <label class="form-label">
                                                            Keterangan
                                                        </label>

                                                        <textarea
                                                            name="keterangan"
                                                            class="form-control"
                                                            rows="3"
                                                            placeholder="Opsional"></textarea>

                                                    </div>

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
                                                    type="submit"
                                                    class="btn btn-success">

                                                    <i class="bi bi-save"></i>
                                                    Simpan Restok

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

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

</script>

@endpush
@push('js')
<script>
$(document).ready(function () {

    $('#batchSelect').select2({
        dropdownParent: $('#modalRestok'),
        width: '100%',
        placeholder: '-- Pilih Batch --'
    });

    $('#batchSelect').on('change', function () {

        let harga = $(this).find(':selected').data('harga');

        if (harga) {

            $('#hargaModal').val(
                new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(harga)
            );

        } else {

            $('#hargaModal').val('');

        }

    });

});

    $('#batchSelect').change(function(){

    let option=$(this).find(':selected');

    $('#namaObat').val(
        option.data('obat')
    );

    $('#stokSaatIni').val(
        option.data('stok')
    );

    $('#expired').val(
        option.data('exp')
    );

    $('#hargaModal').val(
        option.data('modal')
    );

});
</script>