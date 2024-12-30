@extends('layouts.app')

@section('title', 'Notes de l\'évaluation')

@section('content')
    <h1>Notes de l'évaluation</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Eleve</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluationEleves as $evaluationEleve)
                <tr>
                    <td>{{ $evaluationEleve->eleve->nom }} {{ $evaluationEleve->eleve->prenom }}</td>
                    <td>{{ $evaluationEleve->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('notes.evaluation.failed', $evaluationEleve->evaluation_id) }}">Voir les notes sous la moyenne</a>
@endsection