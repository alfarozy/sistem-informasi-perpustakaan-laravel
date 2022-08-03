@extends('layouts.backoffice')
@section('title', 'Kelola Laporan buku')

@section('content')
    <div class="container-fluid">
        {{-- filter --}}
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Filter tanggal</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="{{ route('laporan.buku') }}" method="get">
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
                            Data buku
                        </h6>

                    </div>
                    <div class="col-lg-6 text-right">

                        <a href="{{ route('laporan.exportBuku', ['start_date' => request()->start_date ?? '-', 'end_date' => request()->end_date ?? '-']) }}"
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
                                <th>Kode buku</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun terbit</th>
                                <th>Kota terbit</th>
                                <th>Rak Buku</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
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
                                        {{ $book->created_at->format('d-m-Y') }}
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
