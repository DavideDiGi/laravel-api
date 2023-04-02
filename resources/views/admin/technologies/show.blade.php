@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-4">

    @include('partials.success')

    <div class="row">

        <div class="col d-flex">
            <h2>{{ $technology->id }}</h2>
            <h2 class="mx-1"> - </h2>
            <h2 class="card-title">{{ $technology->name }}</h2>
            <div class="col d-flex">
                <a href="{{ route('admin.technologies.index') }}" class="btn btn-dark w-25 fs-5 ms-5">Torna indietro</a>
            </div>
        </div>
        {{-- <a href="{{ route('admin.technologies.index') }}" class="btn btn-dark w-25">Torna indietro</a> --}}


    </div>

    <div class="w-50 ms-5 pe-4  pb-4 ">

        {{-- <p class="title-slug small ">{{ $technology->slug }}</p> --}}
        {{-- <h4>Tipo progetto: {{ $technology->type ? $technology->type->name : 'Non definito' }}</h4> --}}
        {{-- <p class="card-text fw-light">{{ $technology->content }}</p> --}}
        {{-- @if ($technology->cover_pic)
            <div class="pb-3">
                <img src="{{ asset('storage/'.$technology->cover_pic) }}" style="width: 250px;" alt="">
            </div>
        @endif --}}
        {{-- <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-warning">Modifica</a>
        <a href="#" class="btn btn-danger">Elimina</a> --}}
        {{-- <a href="{{ route('admin.technologies.index') }}" class="btn btn-dark float-end">Torna indietro</a> --}}

    </div> 

</div>

@endsection
