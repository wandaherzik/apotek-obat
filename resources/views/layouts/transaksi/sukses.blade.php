<!DOCTYPE html>

<html>
<head>
    <title>Transaksi Berhasil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5">

```
<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-sm">

            <div class="card-body text-center p-5">

                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success" style="font-size:64px"></i>
                </div>

                <h3 class="mb-2">Transaksi Berhasil</h3>

                <p class="text-muted mb-4">
                    Transaksi <b>{{ $transaksi->kode_transaksi }}</b> berhasil disimpan.
                </p>

                <div class="d-grid gap-2">

                    <a href="{{ route('transaksi.cetak',$transaksi->id_transaksi) }}"
                       target="_blank"
                       class="btn btn-success btn-lg">

                        <i class="bi bi-printer"></i>
                        Cetak Struk

                    </a>

                    <a href="{{ route('transaksi.index') }}"
                       class="btn btn-primary btn-lg">

                        <i class="bi bi-cart-plus"></i>
                        Transaksi Baru

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>
```

</div>

</body>
</html>
