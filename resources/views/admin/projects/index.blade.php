@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col">
            <h1>Tutti i progetti</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card-container">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-success text-center mb-3">Aggiungi un nuovo progetto</a>

            @include('partials.success')

            @foreach ($projects as $project)
                
                <div class="card mb-3 w-75">
                    
                    <img src="" class="cover card-img-top" alt="">
                    
                    <div class="card-body">

                        <div class="d-flex">
                            <h5>{{ $project->id }}</h5>
                            <h5 class="mx-1"> - </h5>
                            <h5 class="card-title">{{ $project->title }}</h5>
                        </div>

                        {{-- <p class="slug card-text"><small class="text-muted">{{ $project->slug }}</small></p> --}}

                        <h6>Tipo: {{ $project->type ? $project->type->name : 'Generico' }}</h6>

                        <div class="d-inline-block mb-3">Tecnologie utilizzate:</div>
                        @if(count($project->technologies) > 0)
                            @foreach ($project->technologies as $technology)
                                <span class="pb-3 fw-bold">
                                    @if (!empty($technology->name)) 
                                        | {{ $technology->name }} |
                                    
                                    @endif
                                </span>
                            @endforeach
                        @else
                            Nessuna tecnologia selezionata
                        @endif

                        <p class="content card-text">{{ $project->content }}</p>

                        @if ($project->cover_pic)
                            <div class="pb-3">
                                <img src="{{ asset('storage/'.$project->cover_pic) }}" style="width: 250px;" alt="">
                            </div>
                        @endif

                        <div class="controls d-flex justify-content-between">

                            <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-dark px-5">Vedi progetto</a>
                            
                            <div class="d-flex">

                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning float-end">Modifica</a>

                                <form class="" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo progetto?');">
                                    
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger ms-2">Elimina</button>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            @endforeach
                    
        </div>

    </div>
</div>

@endsection