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
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                                <form class="user" action="{{ route('login') }}" method="POST">
                                    @csrf
                                  <div class="from-group mb-4">

                                    <select name= level required class ="form-control" aria-label="size 3 select example">
                                        <option selected disabled >Pilih level </option>
                                        <option value="anggota">Anggota</option>
                                        <option value="pustakawan">Pustakawan</option>
                                        <option value="kepsek">Kepala Sekolah</option>
                                      </select>
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
                                    <button class="btn btn-success btn-user btn-block" type="submit">Login</button>
                                </form>
                                <hr />
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Belum punya akun, daftar
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
