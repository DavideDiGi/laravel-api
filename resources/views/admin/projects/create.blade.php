@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-4">

    <div class="row justify-content-center">
        <h2>Crea un nuovo progetto</h2>
    </div>

    @include('partials.errors')

    <div class="row mb-4">

        <div class="col">
            
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Titolo<span>*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required value="{{ old('title') }}" placeholder="Inserisci titolo...">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Descrizione<span>*</span></label>
                    <textarea class="form-control" rows="5" id="content" name="content" required placeholder="Inserisci una descrizione...">{{ old('content') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="type_id" id="type_id" class="form-label">Tipo: </label>
                    <select name="type_id" id="type_id">
                        <option value="">Generico</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
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
                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} 
                        value="{{ $technology->id }}">
                        
                        <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach

                <div class="my-3 ">
                    <label for="cover_pic" class="form-label">Inserisci una copertina</label>
                    <input type="file" class="form-control" id="cover_pic" name="cover_pic" accept="image/*"> 
                </div>

                <div>
                    <p class=" small fw-light text-secondary d-inline-block">i campi contrasegnati con <span>*</span> sono obbligatori</p>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-dark float-end">Torna indietro</a>
                </div>

                    <button type="submit" class="btn btn-success">Crea progetto</button>

            </form>

        </div>

    </div>

</div>

@endsection
