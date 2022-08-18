<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>Kode Transaksi : {{ $count }}</h1>
    <table style="width: 100%">
        <tr>
            <th>Banyak</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
        </tr>
        @foreach ($transactions as $transaction)
            @for ($i = 0; $i < count($transaction); $i++)
                <tr>
                    <td>{{ $transaction[$i]->id }}</td>
                    <td>{{ $transaction[$i]->name }}</td>
                    <td>{{ $transaction[$i]->created_at }}</td>
                </tr>
            @endfor
        @endforeach
        <form action="{{ route('admin.transaction.create') }}" method="post">
            @csrf
            <input type="hidden" name="count" value="{{ $count }}">
            <tr>
                <td><input type="number" name="quantity[]"></td>
                <td><input type="text" name="item[]"></td>
            </tr>
            <tr>
                <td><input type="number" name="quantity[]"></td>
                <td><input type="text" name="item[]"></td>
            </tr>
            <tr>
                <td colspan="3"><input type="number" name="discount"></td>
            </tr>
            <tr>
                <td colspan="4"><button type="submit">Tambah</button></td>
            </tr>
        </form>
    </table>
</body>

</html>
