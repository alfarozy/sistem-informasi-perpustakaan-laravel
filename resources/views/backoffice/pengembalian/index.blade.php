@extends('layouts.backoffice')
@section('title', 'Kelola pengembalian')
@section('content')
    @php
    $total_denda = 0;
    @endphp
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Data pengembalian
                        </h6>
                    </div>
                    <div class="col-lg-6 text-right">

                        {{-- <a href="{{ route('peminjaman.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah
                            data</a> --}}
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
                                <th>Tanggal peminjaman</th>
                                <th>Tanggal kembali</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Lama hari peminjaman</th>
                                <th>Denda</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
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

                                            <button class="btn btn-sm btn-warning">Buku Belum dikembalikan</button>
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
                                            dari {{ $dendaHari + $days }} hari denda {{ $dendaHari }} hari
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
                                    <td>
                                        <a href="{{ route('pengembalian.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary"><i class="fa fa-book"></i> Pengembalian</a>

                                        {{-- <form class="d-inline"
                                            action="{{ route('peminjaman.destroy', $item->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="8" class="text-right"><b>Total Denda</b></td>
                                <td colspan="2"><b>Rp{{ number_format($total_denda, 0, ',', '.') }}</b></td>

                            </tr>

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
