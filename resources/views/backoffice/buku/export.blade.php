<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">

</head>

<body>
    <table class="table table-striped">
        <thead class="">
            <tr>
                <th>No</th>
                <th>Kode buku</th>
                <th>Judul buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun terbit</th>
                <th>Kota terbit</th>
                <th>Rak buku</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->kode_buku }}</td>
                    <td>{{ $row->nama_buku }}</td>
                    <td>{{ $row->pengarang }}</td>
                    <td>{{ $row->penerbit }}</td>
                    <td>{{ $row->tahun_terbit }}</td>
                    <td>{{ $row->kota_terbit }}</td>
                    <td>{{ $row->rak_buku }}</td>
                    <td>{{ $row->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1"></td>
                <td align="left">Total</td>
                <td align="left" class="gray">{{ $books->count() }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
