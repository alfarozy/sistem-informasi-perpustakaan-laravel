@extends('layouts.backoffice')
@section('title', $buku->nama_buku)
@section('content')
    <div class="container-fluid" style="height: 90vh">
        <embed src="/storage/{{ $buku->ebook }}" type="application/pdf" frameBorder="0" scrolling="auto" height="100%"
            width="100%"></embed>
    </div>
@endsection
