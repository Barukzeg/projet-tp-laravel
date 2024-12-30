@extends('layouts.app')

@section('title', 'Modifier une note')

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
    <h1>Modifier la note : {{ $note->note }}</h1>

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

    <!-- Formulaire pour modifier une note -->
    <form action="{{ route('evaluationEleves.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="note">Note :</label>
            <input type="number" name="note" id="note" value="{{ old('note') }}" step="0.01" required>
        </div>
        <div>
            <label for="evaluation_id">Evaluation :</label>
            <select name="evaluation_id" id="evaluation_id" required>
                @foreach ($evaluations as $evaluation)
                    <option value="{{ $evaluation->id }}">{{ $evaluation->titre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="eleve_id">Eleve :</label>
            <select name="eleve_id" id="eleve_id" required>
                @foreach ($eleves as $eleve)
                    <option value="{{ $eleve->id }}">{{ $eleve->nom }} {{ $eleve->prenom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Mettre à jour</button>
    </form>
@endsection
