@extends('layouts.app')

@section('title', 'Afficher une note')

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
    <h1>Détails de la note : {{ $evaluationEleve->note }} </h1>

    <ul>
        <li>Eleve : {{ $evaluationEleve->eleve->numero_etudiant }}</li>
        <li>Evaluation : {{ $evaluationEleve->evaluation->titre }}</li>
        <li>Note : {{ $evaluationEleve->note }}</li>
    </ul>

    <a href="{{ route('evaluationEleves.edit', $evaluationEleve->id) }}">Modifier</a>

    <!-- Formulaire de suppression -->
    <form action="{{ route('evaluationEleves.destroy', $evaluationEleve->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
@endsection
