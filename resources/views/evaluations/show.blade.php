@extends('layouts.app')

@section('title', 'Afficher une evaluation')

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
    <h1>Détails de l'evaluation : {{ $evaluation->titre }} </h1>

    <ul>
        <li>Titre : {{ $evaluation->titre }}</li>
        <li>Date : {{ $evaluation->date }}</li>
        <li>Coefficient : {{ $evaluation->coefficient }}</li>
        <li>Module : {{ $evaluation->module->nom }}</li>
    </ul>

    <a href="{{ route('evaluations.edit', $evaluation->id) }}">Modifier</a>

    <!-- Formulaire de suppression -->
    <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>

    <a href="{{ route('notes.evaluation', $evaluation->id) }}">Voir les notes</a>
@endsection
