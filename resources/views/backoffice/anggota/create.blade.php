@extends('layouts.backoffice')
@section('title', 'Kelola anggota')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary ">
                            Tambah anggota
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="name" aria-describedby="name"
                            placeholder="" />
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" aria-describedby="email"
                            placeholder="" />
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Nis / Nip</label>
                        <input type="text" class="form-control" id="email" name="nis_nip" aria-describedby="email"
                            placeholder="" />
                        @error('nis_nip')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Level</label>
                        <select required name="level" class="form-control" id="exampleFormControlSelect1">
                            <option selected>-- Pilih level --</option>
                            <option value="anggota">Anggota Pustaka</option>
                            <option value="pustakawan">Pustakawan</option>
                            <option value="kepsek">Kepala Sekolah</option>
                        </select>
                        @error('level')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" name="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="" />
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-2">
                            <img class="col-lg-12" src="/storage/{{ Auth()->user()->img }}" alt="" srcset="">
                        </div>
                        <div class="form-group col-lg-10">
                            <label for="ecook">Upload foto anggota</label>
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="validatedCustomFile">
                                <label class="custom-file-label" for="validatedCustomFile">Pilih gambar</label>
                            </div>
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
