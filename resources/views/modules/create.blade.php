@extends('layouts.app')

@section('title', 'Créer un module')

@section('content')
    <h1>Ajouter un nouvel module</h1>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire pour créer un module -->
    <form action="{{ route('modules.store') }}" method="POST">
        @csrf
        <div>
            <label for="code">Code :</label>
            <input type="text" name="code" id="code" value="{{ old('code') }}" required>
        </div>
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required>
        </div>
        <div>
            <label for="coefficient">Coefficient :</label>
            <input type="number" name="coefficient" id="coefficient" value="{{ old('coefficient') }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection