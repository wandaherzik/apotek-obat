@extends('layouts.app')

@section('title','Transaksi')

@section('content')

<form
    action="{{ route('transaksi.store') }}"
    method="POST"
    id="formTransaksi">

    @csrf
<input
    type="hidden"
    name="cart"
    id="cartInput">

<div class="row">

    <div class="col-md-3">

        <label>Kode Transaksi</label>

        <input
            class="form-control"
            value="{{ $kode }}"
            readonly>

    </div>

    <div class="col-md-3">

        <label>Tanggal</label>

        <input
            class="form-control"
            value="{{ now()->format('d-m-Y H:i') }}"
            readonly>

    </div>

    <div class="col-md-3">

        <label>Kasir</label>

        <input
            class="form-control"
            value="{{ auth()->user()->nama }}"
            readonly>

    </div>

    <div class="col-md-3">

        <label>Pembeli</label>

        <input
            type="text"
            class="form-control"
            id="namaPembeli"
            name="nama_pembeli">

    </div>

</div>

<div class="mt-4">

<div class="row mb-3">

    <div class="col-md-6">

     <label class="form-label fw-bold">

    <i class="bi bi-search"></i>

    Cari Obat

</label>

        <select
            id="pilihObat"
            class="form-select">

            <option value="">Pilih Obat</option>

            @foreach($obat as $item)

                <option
                    value="{{ $item->id_obat }}"
                    data-barcode="{{ $item->barcode }}"
                    data-nama="{{ $item->nama_obat }}"
                    data-harga="{{ $item->harga_jual }}"
                    data-satuan="{{ $item->satuan->nama_satuan }}">

                    {{ $item->nama_obat }}
                    | {{ $item->kode_obat }}
                    | {{ $item->satuan->nama_satuan }}

                </option>

            @endforeach

        </select>

    </div>

</div>


</div>

<table class="table table-bordered mt-3">

    <thead>

        <tr>

            <th width="5%">No</th>

            <th>Nama Obat</th>

            <th width="10%">Qty</th>

            <th width="15%">Harga</th>

            <th width="15%">Subtotal</th>

            <th width="10%">Aksi</th>

        </tr>

    </thead>

    <tbody id="cartBody">

        <tr>

            <td colspan="6" class="text-center">

                Belum ada obat.

            </td>

        </tr>

    </tbody>

</table>


<div class="row mt-4">

    <div class="col-md-8"></div>

    <div class="col-md-4">

        <table class="table">

            <tr>

                <th>Total</th>

                <th class="text-end">

                    <span id="grandTotal">

                        Rp0

                    </span>

                </th>

            </tr>

        </table>

    </div>

</div>

<div class="card mt-3">

    <div class="card-header">

        <h5>
            Pembayaran
        </h5>

    </div>

    <div class="card-body">

        <div class="mb-3">

            <label>Metode Pembayaran</label>

            <select
                class="form-select"
                name="metode_bayar"
                id="metodeBayar">

                <option value="CASH">Cash</option>

                <option value="QRIS">QRIS</option>

                <option value="TRANSFER">Transfer</option>

            </select>

        </div>

        <div class="mb-3">

            <label>Total Bayar</label>

            <input
                type="number"
                class="form-control"
                id="totalBayar"
                name="total_bayar">

        </div>

        <div class="mb-3">

            <label>Kembalian</label>

            <input
                type="text"
                class="form-control"
                id="kembalian"
                readonly>

        </div>

        <button
            type="submit"
            class="btn btn-success w-100"
            id="btnSimpan">

            <i class="bi bi-check-circle"></i>

            Simpan Transaksi

        </button>

    </div>

</div>
</form>
@endsection

@push('css')
<style>
/* Tinggi kotak Select2 */
.select2-container .select2-selection--single{
    height:45px !important;
    border-radius:8px;
    border:1px solid #ced4da;
}

.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height:43px;
    padding-left:12px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow{
    height:43px;
}

/* Dropdown */
.select2-results__option{
    padding:12px 15px;
}

/* Hover */
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
    background:#f8f9fa !important;
    color:#212529 !important;
}

/* Item yang dipilih */
.select2-results__option--selected{
    background:#ffffff !important;
    color:#212529 !important;
}

/* Scroll */
.select2-results{
    max-height:350px;
}

</style>
@endpush

@push('js')
<script>
let cart = [];

$('#pilihObat').select2({

    width:'100%',

    placeholder:'Cari nama obat / kode / barcode',

    minimumInputLength:1,

    ajax:{

        url:"{{ route('transaksi.cariObat') }}",

        dataType:'json',

        delay:300,

        data:function(params){

            return{

                search:params.term

            }

        },

            processResults:function(data){

                return {
                    results:data.results
                };

            }

    },

    templateResult:formatObat,

    templateSelection:function(item){

        return item.nama || item.text;

    }

});

function formatObat(item){

    if(!item.id){

        return item.text;

    }

    let badge='';

    if(item.stok<=item.minimum){

        badge='<span class="badge bg-danger">Stok Minimum</span>';

    }else{

        badge='<span class="badge bg-success">Ready</span>';

    }

    return $(`

        <div>

            <strong>

                 ${item.nama}

            </strong>

            ${badge}

            <br>

            <small>

                Kode :

                ${item.kode}

                |

                Barcode :

                ${item.barcode ?? '-'}

            </small>

            <br>

            <small>

                Stok :

                ${item.stok}

                ${item.satuan}

            </small>

            <br>

            <small>

                Harga :

                ${rupiah(item.harga)}

            </small>

        </div>

    `);

}

$('#pilihObat').on('select2:select',function(e){

    let item=e.params.data;

    if(item.stok<=0){

        Swal.fire({

            icon:'warning',

            title:'Stok Habis',

            text:'Obat ini tidak memiliki stok.'

        });

        return;

    }

    let index=cart.findIndex(x=>x.id==item.id);

    if(index>=0){

        cart[index].qty++;

    }else{

        cart.push({

            id:item.id,

            nama:item.nama,

            harga:parseFloat(item.harga),

            qty:1,

            stok:item.stok

        });

    }

    renderCart();

    $(this).val(null).trigger('change');

});
function ubahQty(index,qty){

    qty=parseInt(qty);

    if(qty<1){

        qty=1;

    }

    if(qty>cart[index].stok){

        Swal.fire({

            icon:'warning',

            title:'Stok Tidak Cukup',

            text:'Stok tersedia hanya '+cart[index].stok

        });

        qty=cart[index].stok;

    }

    cart[index].qty=qty;

    renderCart();

}



function hapusItem(index){

    cart.splice(index,1);

    renderCart();

}

function rupiah(angka){

    return new Intl.NumberFormat('id-ID',{

        style:'currency',

        currency:'IDR'

    }).format(angka);

}

function renderCart(){
    

    let tbody = '';
    let total = 0;

    if(cart.length == 0){

        tbody = `
        <tr>
            <td colspan="6" class="text-center">
                Belum ada obat.
            </td>
        </tr>
        `;

    }else{

        cart.forEach((item,index)=>{

            let subtotal = item.qty * item.harga;

            total += subtotal;

            tbody += `
            <tr>

                <td>${index+1}</td>

                <td>${item.nama}</td>

                <td>

                    <input
                        type="number"
                        min="1"
                        value="${item.qty}"
                        class="form-control"
                        onchange="ubahQty(${index}, this.value)">

                </td>

                <td>${rupiah(item.harga)}</td>

                <td>${rupiah(subtotal)}</td>

                <td>

                    <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        onclick="hapusItem(${index})">

                        <i class="bi bi-trash"></i>

                    </button>

                </td>

            </tr>
            `;

        });

    }

    $('#cartBody').html(tbody);

    $('#grandTotal').html(rupiah(total));

}
$('#bayar').on('keyup change', function () {

    let bayar = parseFloat($(this).val()) || 0;

    let total = cart.reduce((t, item) => t + (item.qty * item.harga), 0);

    $('#kembalian').val(rupiah(bayar - total));

});

$('#totalBayar').on('keyup change',function(){

    let bayar=parseFloat($(this).val()) || 0;

    let total=cart.reduce((sum,item)=>{

        return sum+(item.qty*item.harga);

    },0);

    $('#kembalian').val(rupiah(bayar-total));

});

$('#formTransaksi').submit(function(e){

    if(cart.length==0){

        e.preventDefault();

        Swal.fire({

            icon:'warning',

            title:'Keranjang masih kosong'

        });

        return;

    }

    $('#cartInput').val(JSON.stringify(cart));

});
</script>
@endpush