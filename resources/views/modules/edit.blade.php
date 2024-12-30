@extends('layouts.app')

@section('title', 'Modifier un module')

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
    <h1>Modifier le module : {{ $module->nom }}</h1>

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

    <!-- Formulaire pour modifier un module -->
    <form action="{{ route('modules.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="code">Code :</label>
            <input type="text" name="code" id="code" value="{{ old('code', $module->code) }}" required>
        </div>
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $module->nom) }}" required>
        </div>
        <div>
            <label for="coefficient">Coefficient :</label>
            <input type="number" name="coefficient" id="coefficient" value="{{ old('coefficient', $module->coefficient) }}" required>
        </div>
        <button type="submit">Mettre à jour</button>
    </form>
@endsection
