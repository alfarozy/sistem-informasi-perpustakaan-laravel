@extends('layouts.backoffice')
@section('title', 'Profil Saya')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Profil {{ Auth()->user()->name }}
                        </h6>
                    </div>
                    <div class="col-lg-6 text-right">

                        <a href="{{ route('profile.edit') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-edit fa-sm text-white-50"></i> Edit profil</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session()->get('msg') }}
                    </div>
                @endif
                <div class="row">
                    <div class="card mb-3 border-white">
                        <div class="row no-gutters" style="max-width: 700px">
                            <div class="col-md-4">
                                <img src="/storage/{{ Auth()->user()->img }}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ Auth()->user()->name }}</h5>
                                    <p class="card-text">{{ Auth()->user()->email }}</p>
                                    <p class="card-text">Nis : {{ Auth()->user()->nis_nip }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
