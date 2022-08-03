@extends('layouts.backoffice')
@section('title', 'Kelola anggota')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Data anggota
                        </h6>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
                            data-target="#import"><i class="fas fa-file-excel fa-sm text-success-50"></i></i>
                            Import
                        </a>
                        <a href="#" data-toggle="modal" data-target="#export"
                            class="d-none d-sm-inline-block btn btn-sm btn-outline-success shadow-sm "><i
                                class="fas fa-file-export fa-sm text-success-50"></i> Export</a>
                        <a href="{{ route('anggota.create') }}"
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
                @if (isset($error) && $error->any())
                    <div class="alert alert-success">
                        @foreach ($error->all() as $item)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nis / Nip</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($anggota as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->nis_nip }}</td>
                                    <td class="text-center">
                                        @if ($item->level == 'kepsek')

                                            <span class="btn btn-sm btn-danger">Kepala Sekolah</span>
                                        @elseif($item->level == 'pustakawan')
                                            <span class="btn btn-sm btn-success">Pustakawan</span>
                                        @else
                                            <span class="btn btn-sm btn-primary">Anggota</span>

                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('anggota.edit', $item->id) }}"
                                            class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                        @if (Auth()->id() != $item->id)

                                            <form class="d-inline"
                                                action="{{ route('anggota.destroy', $item->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
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
                        <button class="btn btn-primary btn-export" type="submit">
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
                    <h5 class="modal-title" id="exampleModalLabel">Import data anggota</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('anggota.import') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center">

                            <a href="{{ route('anggota.download') }}" class="btn btn-outline-primary"> <i
                                    class="fa fa-download"></i> Download format data
                                anggota</a>
                        </div>
                        <hr class="my-3">
                        <p>Upload data anggota</p>
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
@section('script')
    <script>
        $('.btn-export').click(function() {
            $('#export').modal('hide')
        });
    </script>
@endsection
