@extends('layouts.backoffice')
@section('title', 'Kelola peminjaman')
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
                            Tambah data peminjaman
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="no_pinjam">No Pinjam</label>
                        <input type="text" class="form-control" id="no_pinjam" value="{{ $no_pinjam }}" name="no_pinjam"
                            aria-describedby="name" />
                        @error('no_pinjam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="buku_id">book id </label>
                        <select class="selectme form-control" name="buku_id">
                            @foreach ($books as $book)

                                <option value="{{ $book->id }}"> ({{ $book->kode_buku }}) - {{ $book->nama_buku }}
                                </option>
                            @endforeach

                        </select>
                        @error('buku_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_id">Anggota</label>
                        <select class="selectme form-control" name="user_id">
                            @foreach ($users as $user)

                                <option value="{{ $user->id }}">({{ $user->nis_nip }}) - {{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal pinjam</label>
                        <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam"
                            aria-describedby="name" />
                        @error('tanggal_pinjam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal kembali</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                            aria-describedby="name" />
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
