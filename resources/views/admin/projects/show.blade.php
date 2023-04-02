@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-4">

    @include('partials.success')

    <div class="row justify-content-center">

        <div class="col d-flex">
            <h3>{{ $project->id }}</h3>
            <h3 class="mx-1"> - </h3>
            <h3 class="card-title">{{ $project->title }}</h3>
        </div>

    </div>

    <div class="w-50 ms-5 pe-4 border-end pb-4 border-bottom">

        {{-- <p class="title-slug small ">{{ $project->slug }}</p> --}}
        <h5>Tipo progetto: {{ $project->type ? $project->type->name : 'Non definito' }}</h5>
        <h5 class="d-inline-block">Tecnologie utilizzate: </h5>
        {{-- <span class="pb-3 fw-bold">{{ $technology ? $technology->name : 'Non ancora selezionata' }} |</span> --}}
        @if(count($project->technologies) > 0)
            @foreach ($project->technologies as $technology)
                <span class="pb-3 fw-bold">
                    @if (!empty($technology->name)) 
                        | {{ $technology->name }} |
                    
                    @endif
                </span>
            @endforeach
        @else
            <span class=" fs-5">
                Nessuna tecnologia selezionata
            </span>
        @endif
        <p class="card-text fw-light">{{ $project->content }}</p>
        @if ($project->cover_pic)
            <div class="pb-3">
                <img src="{{ asset('storage/'.$project->cover_pic) }}" style="width: 250px;" alt="">
            </div>
        @endif
        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">Modifica</a>
        <a href="#" class="btn btn-danger">Elimina</a>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-dark float-end">Torna indietro</a>

    </div> 

</div>

@endsection
