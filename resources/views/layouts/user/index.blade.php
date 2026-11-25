@extends('layouts.app')

@section('title','Manajemen User')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h4 class="mb-0">

            Manajemen User

        </h4>



    </div>

    <div class="card-body">
                <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">

            <i class="bi bi-plus-circle"></i>

            Tambah User

        </button>

        <table class="table table-bordered table-striped" id="tableUser">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nama</th>

                    <th>Username</th>

                    <th>Role</th>

                    <th>Status</th>

                    <th width="170">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach($user as $u)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $u->nama }}</td>

                    <td>{{ $u->username }}</td>

                    <td>

                        <span class="badge bg-primary">

                            {{ $u->role }}

                        </span>

                    </td>

                    <td>

                        @if($u->status)

                            <span class="badge bg-success">

                                Aktif

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Nonaktif

                            </span>

                        @endif

                    </td>

                    <td>

<button
    type="button"
    class="btn btn-warning btn-sm btn-edit"

    data-id="{{ $u->id_user }}"
    data-nama="{{ $u->nama }}"
    data-username="{{ $u->username }}"
    data-role="{{ $u->role }}"
    data-status="{{ $u->status }}">

    <i class="bi bi-pencil"></i>

</button>

<button
    type="button"
    class="btn btn-danger btn-sm btn-hapus"
    data-id="{{ $u->id_user }}"
    data-nama="{{ $u->nama }}">

    <i class="bi bi-trash"></i>

</button>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>
@include('layouts.user.modalEdit')

@include('layouts.user.modalTambah')
<form
    id="formHapus"
    method="POST"
    style="display:none;">

    @csrf
    @method('DELETE')

</form>

@endsection

@push('js')

<script>

document.querySelectorAll('.btn-edit').forEach(button=>{

    button.addEventListener('click',function(){

        let id=this.dataset.id;

        document.getElementById('editNama').value=this.dataset.nama;

        document.getElementById('editUsername').value=this.dataset.username;

        document.getElementById('editRole').value=this.dataset.role;

        document.getElementById('editStatus').value=this.dataset.status;

        document.getElementById('formEdit').action="/user/"+id;

        new bootstrap.Modal(
            document.getElementById('modalEdit')
        ).show();

    });

});
$('#tableUser').DataTable();


document.querySelectorAll('.btn-hapus').forEach(button=>{

    button.addEventListener('click',function(){

        let id=this.dataset.id;

        let nama=this.dataset.nama;

        Swal.fire({

            title:'Hapus User?',

            text:'User "'+nama+'" akan dihapus.',

            icon:'warning',

            showCancelButton:true,

            confirmButtonColor:'#d33',

            cancelButtonColor:'#6c757d',

            confirmButtonText:'Ya, Hapus',

            cancelButtonText:'Batal'

        }).then((result)=>{

            if(result.isConfirmed){

                let form=document.getElementById('formHapus');

                form.action="/user/"+id;

                form.submit();

            }

        });

    });

});

</script>

@endpush