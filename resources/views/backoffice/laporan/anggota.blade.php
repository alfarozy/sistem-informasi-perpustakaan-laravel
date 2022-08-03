@extends('layouts.backoffice')
@section('title', 'Kelola Laporan anggota')

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
                    <form action="{{ route('laporan.anggota') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="start_date">Level</label>
                                <select required name="level" class="form-control" id="exampleFormControlSelect1">
                                    <option value="all" {{ request()->level == 'all' ? 'selected' : '' }}> Semua Level </option>
                                    <option value="anggota" {{ request()->level == 'anggota' ? 'selected' : '' }}>Anggota
                                        Pustaka</option>
                                    <option value="pustakawan" {{ request()->level == 'pustakawan' ? 'selected' : '' }}>
                                        Pustakawan</option>
                                    <option value="kepsek" {{ request()->level == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="start_date">Tanggal mulai</label>
                                <input type="date" value="{{ request()->start_date ?? null }}" class="form-control"
                                    id="start_date" name="start_date" aria-describedby="name" />
                            </div>
                            <div class="form-group col-md-4">
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
                            Data anggota
                        </h6>

                    </div>
                    <div class="col-lg-6 text-right">

                        <a href="{{ route('laporan.exportAnggota', ['level' => request()->level, 'start_date' => request()->start_date ?? '-', 'end_date' => request()->end_date ?? '-']) }}"
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nis / Nip</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->nis_nip }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td>
                                        {{ $item->created_at->format('d-m-Y') }}
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
