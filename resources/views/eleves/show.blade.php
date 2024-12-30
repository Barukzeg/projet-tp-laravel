@extends('layouts.app')

@section('title', 'Afficher un élève')

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
    <h1>Détails de l'élève : {{ $eleve->nom }} {{ $eleve->prenom }}</h1>

    <ul>
        <li><strong>Nom :</strong> {{ $eleve->nom }}</li>
        <li><strong>Prénom :</strong> {{ $eleve->prenom }}</li>
        <li><strong>Date de Naissance :</strong> {{ $eleve->date_naissance }}</li>
        <li><strong>Numéro Étudiant :</strong> {{ $eleve->numero_etudiant }}</li>
        <li><strong>Email :</strong> {{ $eleve->email }}</li>
        <li><strong>Image :</strong> <img src="{{ asset('storage/' . $eleve->image) }}" alt="image de {{ $eleve->prenom }} {{ $eleve->nom }}" width="100"></li>
    </ul>

    <a href="{{ route('eleves.edit', $eleve->id) }}">Modifier</a>

    <!-- Formulaire de suppression -->
    <form action="{{ route('eleves.destroy', $eleve->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>

    <a href="{{ route('notes.eleve', $eleve->id) }}">Voir les notes</a>
@endsection
