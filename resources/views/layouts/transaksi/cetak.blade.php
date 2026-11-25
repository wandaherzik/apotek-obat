<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Struk {{ $transaksi->kode_transaksi }}</title>

<style>

@page{
    size:58mm auto;
    margin:2mm;
}

body{
    width:58mm;
    margin:auto;
    font-family:monospace;
    font-size:12px;
    color:#000;
}

.center{
    text-align:center;
}

.line{
    border-top:1px dashed #000;
    margin:5px 0;
}

table{
    width:100%;
    border-collapse:collapse;
}

td{
    vertical-align:top;
    padding:2px 0;
}

.right{
    text-align:right;
}

.bold{
    font-weight:bold;
}

@media print{

button{
display:none;
}

}

</style>

</head>

<body>

<button onclick="window.print()">
Cetak
</button>

<div class="center">

<b style="font-size:15px">
Apotek Khadijah
</b>

<br>

Jl. ...................................

<br>

Telp. 08xxxxxxxxxx

</div>

<div class="line"></div>

Kode :

{{ $transaksi->kode_transaksi }}

<br>

{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y H:i') }}

<br>

Kasir :

{{ $transaksi->user->nama }}

<br>

Pembeli :

{{ $transaksi->nama_pembeli ?: '-' }}

<div class="line"></div>

@foreach($transaksi->detail as $item)

<div>

<b>

{{ $item->batch->obat->nama_obat }}

</b>

</div>

<table>

<tr>

<td>

{{ $item->jumlah }}

x

{{ number_format($item->harga_jual,0,',','.') }}

</td>

<td class="right">

{{ number_format($item->subtotal,0,',','.') }}

</td>

</tr>

</table>

@endforeach

<div class="line"></div>

<table>

<tr>

<td>Total</td>

<td class="right">

{{ number_format($transaksi->total_harga,0,',','.') }}

</td>

</tr>

<tr>

<td>Bayar</td>

<td class="right">

{{ number_format($transaksi->total_bayar,0,',','.') }}

</td>

</tr>

<tr>

<td>Kembali</td>

<td class="right">

{{ number_format($transaksi->kembalian,0,',','.') }}

</td>

</tr>

</table>

<div class="line"></div>

<div class="center">

*** TERIMA KASIH ***

<br>

Semoga Lekas Sembuh

</div>

<script>

window.onload=function(){

    window.print();

}

</script>

</body>

</html>