<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan FinTrack AI</title>

    <style>
        body{
            font-family: DejaVu Sans;
            font-size:12px;
        }

        h1{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table,
        th,
        td{
            border:1px solid #000;
        }

        th,
        td{
            padding:8px;
        }

        th{
            background:#f2f2f2;
        }
    </style>
</head>
<body>

<h1>
    Laporan Keuangan FinTrack AI
</h1>

<p>
    Total Pemasukan :
    Rp {{ number_format($income,0,',','.') }}
</p>

<p>
    Total Pengeluaran :
    Rp {{ number_format($expense,0,',','.') }}
</p>

<p>
    Saldo :
    Rp {{ number_format($balance,0,',','.') }}
</p>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tipe</th>
            <th>Nominal</th>
        </tr>
    </thead>

    <tbody>

    @foreach($transactions as $trx)

    <tr>
        <td>
            {{ $trx->date }}
        </td>

        <td>
            {{ $trx->title }}
        </td>

        <td>
            {{ $trx->category }}
        </td>

        <td>
            {{ $trx->type }}
        </td>

        <td>
            Rp {{ number_format($trx->amount,0,',','.') }}
        </td>
    </tr>

    @endforeach

    </tbody>
</table>

</body>
</html>