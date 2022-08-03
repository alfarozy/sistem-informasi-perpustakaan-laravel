@extends('layouts.backoffice')
@section('title', 'Kelola peminjaman')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Data peminjaman
                        </h6>
                    </div>
                    <div class="col-lg-6 text-right">

                        <a href="{{ route('peminjaman.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                <th>No</th>
                                <th>Nomor Pinjam</th>
                                <th>Judul</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal pinjam</th>
                                <th>Tanggal kembali</th>
                                <th>Lama hari</th>
                                <th>Aksi</th>
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
                                    <td>
                                        <a href="{{ route('peminjaman.edit', $item->id) }}"
                                            class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>

                                        <form class="d-inline"
                                            action="{{ route('peminjaman.destroy', $item->id) }}" method="POST">
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
