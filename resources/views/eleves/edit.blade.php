@extends('layouts.app')

@section('title', 'Modifier un élève')

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
    <h1>Modifier l'élève : {{ $eleve->nom }} {{ $eleve->prenom }}</h1>

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

    <!-- Formulaire pour modifier un élève -->
    <form action="{{ route('eleves.update', $eleve->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $eleve->nom) }}" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $eleve->prenom) }}" required>
        </div>
        <div>
            <label for="date_naissance">Date de Naissance :</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $eleve->date_naissance) }}" required>
        </div>
        <div>
            <label for="numero_etudiant">Numéro Étudiant :</label>
            <input type="text" name="numero_etudiant" id="numero_etudiant" value="{{ old('numero_etudiant', $eleve->numero_etudiant) }}" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="{{ old('email', $eleve->email) }}" required>
        </div>
        <div>
            <label for="image">Image :</label>
            <input type="file" name="image" id="image" required>
        </div>
        <button type="submit">Mettre à jour</button>
    </form>

@endsection
