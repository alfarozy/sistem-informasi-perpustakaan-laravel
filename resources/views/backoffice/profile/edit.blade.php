@extends('layouts.backoffice')
@section('title', 'Profil Saya')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Edit Profil
                        </h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session()->get('msg') }}
                    </div>
                @endif
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" value="{{ Auth()->user()->name }}" class="form-control" id="name"
                                name="name" aria-describedby="name" />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="email">Alamat Email</label>
                            <input type="text" class="form-control bg-light" readonly value="{{ Auth()->user()->email }}"
                                id="email" name="email" aria-describedby="name" />
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @else
                                <small class="text-muted">Hubungi pihak pustaka untuk mengganti email anda</small>

                            @enderror
                        </div>


                        <div class="form-group col-lg-6">
                            <label for="nis_nip">Nis</label>
                            <input type="number" class="form-control" value="{{ Auth()->user()->nis_nip }}" id="nis_nip"
                                name="nis_nip" aria-describedby="name" />
                            @error('nis_nip')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                aria-describedby="name" />
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @else
                                <small class="text-muted">Kosongkan jika tidak ingin menukar password</small>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-lg-2">
                            <img class="col-lg-12 img-thumbnail" src="/storage/{{ Auth()->user()->img }}" alt=""
                                srcset="">
                        </div>
                        <div class="form-group col-lg-10">
                            <label for="ecook">Upload foto profil</label>
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
