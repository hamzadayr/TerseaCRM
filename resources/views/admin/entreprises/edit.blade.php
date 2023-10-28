@extends('layouts.app')

@section('content')
    <h1>Éditer une Entreprise</h1>

    <form method="post" action="{{ route('entreprises.update', $entreprise->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="nom">Nom de l'entreprise</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $entreprise->nom }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description de l'entreprise</label>
            <textarea class="form-control" id="description" name="description" required>{{ $entreprise->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="logo">Logo de l'entreprise</label>
            <input type="file" class="form-control-file" id="logo" name="logo">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
