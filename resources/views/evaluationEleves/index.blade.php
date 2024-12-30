@extends('layouts.app')

@section('title', 'Index des notes')

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
    <h1>Liste des notes</h1>

    <a href="{{ route('evaluationEleves.create') }}">Ajouter une nouvelle note</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Eleve</th>
                <th>Evaluation</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluationEleves as $evaluationEleve)
                <tr>
                    <td>{{ $evaluationEleve->eleve->numero_etudiant }}</td>
                    <td>{{ $evaluationEleve->evaluation->titre }}</td>
                    <td>{{ $evaluationEleve->note }}</td>
                    <td>
                        <a href="{{ route('evaluationEleves.show', $evaluationEleve->id) }}">Voir</a>
                        <a href="{{ route('evaluationEleves.edit', $evaluationEleve->id) }}">Modifier</a>

                        <!-- Formulaire de suppression -->
                        <form action="{{ route('evaluationEleves.destroy', $evaluationEleve->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
