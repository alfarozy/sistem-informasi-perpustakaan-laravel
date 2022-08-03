@extends('layouts.backoffice')
@section('title', 'Kelola pengembalian')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .select2-selection {
            width: 100%;
            height: 40px !important;
        }

        .select2-selection {
            padding: 4px !important;

        }

    </style>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary ">
                            Pengembalian buku pustaka
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('pengembalian.update', $data->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="no_pinjam">No Pinjam</label>
                        <input readonly type="text" class="form-control" value="{{ $data->no_pinjam }}" id="no_pinjam"
                            name="no_pinjam" aria-describedby="name" />
                        @error('no_pinjam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="buku_id">Buku</label>
                        <input readonly type="text" class="form-control"
                            value="{{ '(' . $data->book->kode_buku . ') ' . $data->book->nama_buku }}" name="no_pinjam"
                            aria-describedby="name" />
                        @error('buku_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_id">Anggota</label>
                        <input readonly type="text" class="form-control"
                            value="{{ '(' . $data->user->nis_nip . ') ' . $data->user->name }}" id="user_id"
                            name="user_id" aria-describedby="name" />
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Peminjaman</label>
                        <input readonly type="date" class="form-control" value="{{ $data->tanggal_pinjam }}"
                            id="tanggal_pinjam" name="tanggal_pinjam" aria-describedby="name" />
                        @error('tanggal_pinjam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal kembali</label>
                        <input readonly type="date" class="form-control" value="{{ $data->tanggal_kembali }}"
                            id="tanggal_kembali" name="tanggal_kembali" aria-describedby="name" />
                        @error('tanggal_kembali')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                        <input type="date" autofocus class="form-control" value="{{ $data->tanggal_pengembalian }}"
                            id="tanggal_pengembalian" name="tanggal_pengembalian" aria-describedby="name" />
                        @error('tanggal_pengembalian')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.selectme').select2({
            placeholder: 'Pilih Item'
        });
    </script>
@endsection
