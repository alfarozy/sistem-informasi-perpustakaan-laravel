@extends('layouts.backoffice')
@section('title', 'Cari buku')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Data buku
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
                                <th>Kode buku</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun terbit</th>
                                <th>Kota terbit</th>
                                <th>Rak Buku</th>
                                <th>Jumlah</th>
                                <th>Aksi </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->kode_buku }}</td>
                                    <td>{{ $book->nama_buku }}</td>
                                    <td>{{ $book->pengarang }}</td>
                                    <td>
                                        {{ $book->penerbit }}
                                    </td>
                                    <td>{{ $book->tahun_terbit }}</td>
                                    <td>{{ $book->kota_terbit }}</td>
                                    <td>
                                        {{ $book->rak_buku }}
                                    </td>
                                    <td>
                                        {{ $book->jumlah }}
                                    </td>
                                    <td>
                                        <a href="{{ route('buku.pinjam', $book->id) }}" class="btn btn-sm btn-success"><i
                                                class="fa fa-book-reader"></i> Pinjam buku</a>
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
