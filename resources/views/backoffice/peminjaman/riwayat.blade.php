@extends('layouts.backoffice')
@section('title', 'Riwayat peminjaman')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Riwayat peminjaman
                        </h6>
                    </div>
                    <div class="col-lg-6 text-right">
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session()->get('msg') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pinjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Total Denda</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $book->no_pinjam }}
                                    </td>
                                    <td>
                                        {{ $book->book->nama_buku }}
                                    </td>
                                    <td>
                                        {{ $book->tanggal_pinjam }}
                                    </td>
                                    <td>
                                        {{ $book->tanggal_kembali }}
                                    </td>
                                    <td>
                                        {{ $book->tanggal_pengembalian ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $days = 0;
                                            $denda = 0;
                                            $start = strtotime($book->tanggal_pinjam);
                                            $end = strtotime($book->tanggal_kembali);
                                            $days = ($end - $start) / 60 / 60 / 24;
                                            
                                            if ($days > 0) {
                                                $start = strtotime($book->tanggal_kembali);
                                                $end = strtotime($book->tanggal_pengembalian);
                                                $dendaHari = ($end - $start) / 60 / 60 / 24;
                                                $denda = $fn::denda($book->tanggal_kembali, $book->tanggal_pengembalian);
                                            }
                                            
                                        @endphp

                                        @if ($book->tanggal_pengembalian && $denda > 0)
                                            Denda {{ $dendaHari }} hari
                                            <br>
                                        @endif
                                        <b> Rp {{ $denda > 0 ? $denda : 0 }}</b>
                                    </td>
                                    <td>
                                        @if ($book->tanggal_pengembalian)

                                            <button type="button" class="btn btn-sm btn-primary"> <i
                                                    class="fa fa-check"></i>
                                                Dikembalikan</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-warning"> <i
                                                    class="fa fa-clock"></i>
                                                Dipinjam</button>

                                        @endif
                                    </td>
                                    <td>
                                        @if ($book->book->ebook)
                                            <a href="{{ route('buku.show', $book->book->id) }}"
                                                class="btn btn-sm btn-light border" title="Baca buku"><i
                                                    class="fas fa-file-pdf text-danger"></i></a>

                                            <a href="{{ route('download.ebook', $book->book->id) }}"
                                                class="btn btn-sm btn-success" title="Download buku"><i
                                                    class="fa fa-download"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
