@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-4">

    <div class="row justify-content-center">
        <h2>Modifica progetto</h2>
    </div>

    @include('partials.success')

    @include('partials.errors')

    <div class="row mb-4">

        <div class="col">
            
            <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Titolo<span>*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required value="{{ old('title', $project->title) }}" placeholder="Inserisci titolo...">
                </div>

                <div class="mb-3">
                    <label for="type_id" id="type_id" class="form-label">Tipo</label>
                    <select name="type_id" id="type_id">
                        <option value="">Generico</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="technologies mb-2">Tecnologie utilizzate:</div>
                @foreach ($technologies as $technology)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" 
                        name="technologies[]" 
                        type="checkbox" 
                        id="technology-{{ $technology->id }}" 
                        @if (old('technologies') && is_array(old('technologies')) && count(old('technologies')) > 0)
                            {{ in_array($technology->id, old('technologies')) ? 'checked' : '' }} 
                        @elseif($project->technologies->contains($technology))
                            checked
                        @endif
                        value="{{ $technology->id }}">
                        
                        <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach

                <div class="mb-3">
                    <label for="content" class="form-label">Descrizione<span>*</span></label>
                    <textarea class="form-control" rows="5" id="content" name="content" required placeholder="Inserisci una descrizione...">{{ old('content', $project->content) }}</textarea>
                </div>

                
                <div class="mb-3">
                    <label for="cover_pic" class="form-label">Copertina</label>
                    @if ($project->cover_pic)
                    <div class="pb-3">
                        <img src="{{ asset('storage/'.$project->cover_pic) }}" style="width: 250px;" alt="">
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" name="delete_pic" id="delete_pic">
                        <label for="delete_pic" class="form-check-label">Elimina copertina</label>
                    </div>
                    @endif
                    <input type="file" class="form-control" id="cover_pic" name="cover_pic" accept="image/*"> 
                </div>
                
                <div>
                    <p class=" small fw-light text-secondary d-inline-block">i campi contrasegnati con <span>*</span> sono obbligatori</p>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-dark float-end">Torna indietro</a>
                </div>
                
                    <button type="submit" class="btn btn-warning">Conferma modifiche</button>
            </form>

        </div>

    </div>

</div>

@endsection
