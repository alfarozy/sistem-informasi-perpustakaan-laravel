@extends('layouts.backoffice')
@section('title', 'Kelola Laporan peminjaman')

@section('content')
    <div class="container-fluid">
        {{-- filter --}}
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Filter tanggal pinjam</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="{{ route('laporan.peminjaman') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Tanggal mulai</label>
                                <input type="date" value="{{ request()->start_date ?? null }}" class="form-control"
                                    id="start_date" name="start_date" aria-describedby="name" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date">Tanggal akhir</label>
                                <input type="date" value="{{ request()->end_date ?? null }}" class="form-control"
                                    id="end_date" name="end_date" aria-describedby="name" />
                            </div>

                        </div>
                        <div class="text-right">

                            <button class="btn btn-primary"> <i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Data peminjaman
                        </h6>

                    </div>
                    <div class="col-lg-6 text-right">

                        <a href="{{ route('laporan.exportPeminjaman', ['start_date' => request()->start_date ?? '-', 'end_date' => request()->end_date ?? '-']) }}"
                            target="_BLANK" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm "><i
                                class="fas fa-file-export fa-sm text-success-50"></i> Export</a>
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
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
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
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
