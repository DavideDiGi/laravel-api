@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col">
            <h1>Tutte le tecnologie</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card-container">
            <a href="{{ route('admin.technologies.create') }}" class="btn btn-success text-center mb-3">Aggiungi una nuova tecnologia</a>

            @include('partials.success')

            @foreach ($technologies as $technology)
                
                <div class="card mb-3 w-75">
                    
                    <img src="" class="cover card-img-top" alt="">
                    
                    <div class="card-body">

                        <div class="d-flex">
                            <h5>{{ $technology->id }}</h5>
                            <h5 class="mx-1"> - </h5>
                            <h5 class="card-title">{{ $technology->name }}</h5>
                        </div>

                        {{-- <p class="slug card-text"><small class="text-muted">{{ $technology->slug }}</small></p> --}}

                        {{-- <h6 class="pb-3 d-flex">Tecnologia: {{ $technology->name }}</h6> --}}

                        <p class="content card-text">{{ $technology->content }}</p>

                        

                        <div class="controls d-flex justify-content-between">

                            <a href="{{ route('admin.technologies.show', $technology->id) }}" class="btn btn-dark px-5">Vedi tecnologia</a>
                            
                            <div class="d-flex">

                                {{-- <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-warning float-end">Modifica</a> --}}

                                <form class="" action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa tecnologia?');">
                                    
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