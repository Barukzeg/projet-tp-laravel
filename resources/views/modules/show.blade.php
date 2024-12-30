@extends('layouts.app')

@section('title', 'Afficher un module')

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
    <h1>Détails du module : {{ $module->nom }} </h1>

    <ul>
        <li>Code : {{ $module->code }}</li>
        <li>Nom : {{ $module->nom }}</li>
        <li>Coefficient : {{ $module->coefficient }}</li>
    </ul>

    <a href="{{ route('modules.edit', $module->id) }}">Modifier</a>

    <!-- Formulaire de suppression -->
    <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
@endsection
