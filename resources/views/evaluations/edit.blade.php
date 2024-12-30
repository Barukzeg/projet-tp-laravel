@extends('layouts.app')

@section('title', 'Modifier une évaluation')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <h1>Modifier l'évaluation : {{ $evaluation->nom }}</h1>

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

    <!-- Formulaire pour modifier une evaluation -->
    <form action="{{ route('evaluations.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required>
        </div>
        <div>
            <label for="date">Date :</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}" required>
        </div>
        <div>
            <label for="coefficient"">Coefficient :</label>
            <input type="number" name="coefficient" id="coefficient" value="{{ old('coefficient') }}" step="0.01" required>
        </div>
        <div>
            <label for="module_id">Module :</label>
            <select name="module_id" id="module_id" required>
                @foreach ($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Mettre à jour</button>
    </form>
@endsection
