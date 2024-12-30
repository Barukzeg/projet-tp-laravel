@extends('layouts.app')

@section('title', 'Créer un élève')

@section('content')
    <h1>Ajouter un nouvel élève</h1>

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

    <!-- Formulaire pour créer un élève -->
    <form action="{{ route('eleves.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required>
        </div>
        <div>
            <label for="date_naissance">Date de Naissance :</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance') }}" required>
        </div>
        <div>
            <label for="numero_etudiant">Numéro Étudiant :</label>
            <input type="text" name="numero_etudiant" id="numero_etudiant" value="{{ old('numero_etudiant') }}" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="image">Image :</label>
            <input type="file" name="image" id="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection