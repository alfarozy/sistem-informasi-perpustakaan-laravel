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
                <th>Tanggal peminjaman</th>
                <th>Tanggal kembali</th>
                <th>Tanggal Pengembalian</th>
                <th>Lama hari peminjaman</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_denda = 0;
            @endphp
            @foreach ($pengembalian as $item)
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
                        @if ($item->tanggal_pengembalian)

                            {{ $item->tanggal_pengembalian }}
                        @else
                            <b>Buku Belum dikembalikan</b>
                        @endif
                    </td>

                    <td>
                        @php
                            $days = 0;
                            $start = strtotime($item->tanggal_pinjam);
                            $end = strtotime($item->tanggal_kembali);
                            $days = ($end - $start) / 60 / 60 / 24;
                            if ($days > 0) {
                                $start = strtotime($item->tanggal_kembali);
                                $end = strtotime($item->tanggal_pengembalian);
                                $dendaHari = ($end - $start) / 60 / 60 / 24;
                                $denda = $fn::denda($item->tanggal_kembali, $item->tanggal_pengembalian);
                            }
                            $total_denda += $denda;
                        @endphp

                        @if ($item->tanggal_pengembalian && $denda > 0)
                            Denda {{ $dendaHari }} hari dari {{ $dendaHari + $days }} hari
                            <br>
                        @else
                            {{ $days }} hari

                        @endif
                    </td>
                    <td>
                        @if ($denda > 0)

                            <b> Rp{{ number_format($denda, 0, ',', '.') }}</b>
                        @else

                            <b>-</b>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7"></td>
                <td align="left">Total denda</td>
                <td align="left"><b> Rp{{ number_format($total_denda, 0, ',', '.') }}</b></td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
