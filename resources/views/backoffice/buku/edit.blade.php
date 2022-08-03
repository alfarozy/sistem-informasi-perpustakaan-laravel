@extends('layouts.backoffice')
@section('title', 'Kelola buku')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary ">
                            Edit buku {{ $buku->nama_buku }}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="kode_buku">Kode buku</label>
                            <input type="text" class="form-control" id="kode_buku" name="kode_buku" aria-describedby="name"
                                value="{{ $buku->kode_buku }}" />
                            @error('kode_buku')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="judul">Judul buku</label>
                            <input type="text" class="form-control" id="judul" name="nama_buku" aria-describedby="name"
                                value="{{ $buku->nama_buku }}" />
                            @error('nama_buku')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="pengarang">Nama Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang"
                                aria-describedby="name" value="{{ $buku->pengarang }}" />
                            @error('pengarang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="penerbit">Nama Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" aria-describedby="name"
                                value="{{ $buku->penerbit }}" />
                            @error('penerbit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="tahun_terbit">Tahun terbit</label>
                            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                                aria-describedby="name" value="{{ $buku->tahun_terbit }}" />
                            @error('tahun_terbit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kota_terbit">Kota terbit</label>
                            <input type="text" class="form-control" id="kota_terbit" name="kota_terbit"
                                aria-describedby="name" value="{{ $buku->kota_terbit }}" />
                            @error('kota_terbit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="rak_buku">Rak buku</label>
                            <input type="text" class="form-control" id="rak_buku" name="rak_buku" aria-describedby="name"
                                value="{{ $buku->rak_buku }}" />
                            @error('rak_buku')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" aria-describedby="name"
                                value="{{ $buku->jumlah }}" />
                            @error('jumlah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ecook">Upload ebook</label>
                        <div class="custom-file">
                            <input type="file" name="ebook" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Pilih file pdf</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
