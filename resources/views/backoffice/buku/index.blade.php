@extends('layouts.backoffice')
@section('title', 'Kelola buku')
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
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
                            data-target="#import"><i class="fas fa-file-excel fa-sm text-success-50"></i></i>
                            Import
                        </a>
                        <a target="_blank" href="{{ route('buku.export') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-outline-success shadow-sm"><i
                                class="fas fa-file-export fa-sm text-success-50"></i> Export</a>
                        <a href="{{ route('buku.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah
                            data</a>
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
                                <th>Aksi</th>
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
                                        @if ($book->ebook)
                                            <a href="{{ route('buku.show', $book->id) }}"
                                                class="btn btn-sm btn-light border" title="Baca buku"><i
                                                    class="fas fa-file-pdf text-danger"></i></a>

                                            <a href="{{ route('download.ebook', $book->id) }}"
                                                class="btn btn-sm btn-success" title="Download buku"><i
                                                    class="fa fa-download"></i></a>
                                        @endif
                                        |
                                        <a href="{{ route('buku.edit', $book->id) }}" class="btn btn-sm btn-secondary"><i
                                                class="fa fa-edit"></i></a>
                                        <form class="d-inline" action="{{ route('buku.destroy', $book->id) }}"
                                            method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Export Modal --}}
    <div class="modal fade" id="export" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export data anggota</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('anggota.export') }}" method="post">
                    @csrf
                    <div class="modal-body border-white">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Level</label>
                            <select required name="level" class="form-control" id="exampleFormControlSelect1">
                                <option selected value="">-- Pilih Level --</option>
                                <option value="all"> Semua Level </option>
                                <option value="anggota">Anggota Pustaka</option>
                                <option value="pustakawan">Pustakawan</option>
                                <option value="kepsek">Kepala Sekolah</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-white">
                        <button class="btn btn-primary" type="submit">
                            Export sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Import Modal --}}
    <div class="modal fade" id="import" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import data buku</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('buku.import') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center">

                            <a href="{{ route('buku.download') }}" class="btn btn-outline-primary"> <i
                                    class="fa fa-download"></i> Download format data
                                buku</a>
                        </div>
                        <hr class="my-3">
                        <p>Upload data buku</p>
                        <div class="custom-file">
                            <input name="file" type="file" required class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Pilih file excel</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary " type="submit">
                            Import sekarang
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
