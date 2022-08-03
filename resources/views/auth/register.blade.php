@extends('layouts.auth')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-5 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center pb-5">
                                    <img class="col-5" src="/backoffice/img/logo.jpg" alt="" srcset="">
                                </div>
                                @if (session()->has('msg'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('msg') }}
                                    </div>
                                @endif

                                <form class="user" action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name"
                                            class="form-control form-control @error('name') is-invalid @enderror"
                                            id="exampleInputnis" aria-describedby="nisHelp" placeholder="Nama Lengkap" />

                                        @error('name')
                                            <small class="text-danger ml-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="nis_nip"
                                            class="form-control form-control @error('nis_nip') is-invalid @enderror"
                                            id="exampleInputnis" aria-describedby="nisHelp" placeholder="Nis" />

                                        @error('nis_nip')
                                            <small class="text-danger ml-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email"
                                            class="form-control form-control @error('email') is-invalid @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" />

                                        @error('email')
                                            <small class="text-danger ml-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password"
                                            class="form-control form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" />
                                        @error('password')
                                            <small class="text-danger ml-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button class="btn btn-success btn-user btn-block" type="submit">Daftar Anggota</button>
                                </form>
                                <hr />
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Sudah punya akun, login
                                        sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
