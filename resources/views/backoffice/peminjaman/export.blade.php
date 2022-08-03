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
                <th>Nomor Pinjam</th>
                <th>Judul</th>
                <th>Nama Peminjam</th>
                <th>Tanggal pinjam</th>
                <th>Tanggal kembali</th>
                <th>Lama hari</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->no_pinjam }}</td>
                    <td>{{ $item->book->nama_buku }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        {{ $item->tanggal_pinjam }}
                    </td>

                    <td>
                        {{ $item->tanggal_kembali }}
                    </td>
                    <td>
                        @php
                            $start = strtotime($item->tanggal_pinjam);
                            $end = strtotime($item->tanggal_kembali);
                            $days = ($end - $start) / 60 / 60 / 24;
                            
                        @endphp
                        {{ $days }} hari
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1"></td>
                <td align="left">Total</td>
                <td align="left" class="gray">{{ $peminjaman->count() }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
