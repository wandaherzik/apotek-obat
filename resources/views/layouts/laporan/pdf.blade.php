<!DOCTYPE html>
<html>
<head>

<style>

body{

font-family:DejaVu Sans;

font-size:12px;

}

table{

width:100%;

border-collapse:collapse;

}

table,th,td{

border:1px solid black;

}

th,td{

padding:5px;

}

.center{

text-align:center;

}

</style>

</head>

<body>

<h2 class="center">

LAPORAN PENJUALAN APOTEK

</h2>

<table>

<thead>

<tr>

<th>No</th>

<th>Kode</th>

<th>Tanggal</th>

<th>Pembeli</th>

<th>Kasir</th>

<th>Total</th>

</tr>

</thead>

<tbody>

@foreach($transaksi as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->kode_transaksi }}</td>

<td>{{ $item->tanggal_transaksi }}</td>

<td>{{ $item->nama_pembeli }}</td>

<td>{{ $item->user->nama }}</td>

<td>

Rp {{ number_format($item->total_harga,0,',','.') }}

</td>

</tr>

@endforeach

</tbody>

</table>

<br>

<h4>

Total Penjualan :

Rp {{ number_format($totalPenjualan,0,',','.') }}

</h4>

<h4>

Total Keuntungan :

Rp {{ number_format($totalKeuntungan,0,',','.') }}

</h4>

</body>

</html>