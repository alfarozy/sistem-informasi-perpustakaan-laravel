@extends('layouts.backoffice')
@section('title', 'Kelola Laporan pengembalian')

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
                    <form action="{{ route('laporan.pengembalian') }}" method="get">
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
                            Data pengembalian
                        </h6>

                    </div>
                    <div class="col-lg-6 text-right">

                        <a href="{{ route('laporan.exportPengembalian', ['start_date' => request()->start_date ?? '-', 'end_date' => request()->end_date ?? '-']) }}"
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

@endsection
