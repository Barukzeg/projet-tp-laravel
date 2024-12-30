@extends('layouts.app')

@section('title', 'Notes de l\'élève')

@section('content')
    <h1>Notes de l'élève</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($evaluationEleves->isNotEmpty())
        <h2>Élève : {{ $evaluationEleves->first()->eleve->nom }} {{ $evaluationEleves->first()->eleve->prenom }}</h2>
    @endif
    <h2>Moyenne : {{ $moyenne }}</h2>

    <table>
        <thead>
            <tr>
                <th>Évaluation</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluationEleves as $evaluationEleve)
                <tr>
                    <td>{{ $evaluationEleve->evaluation->titre }}</td>
                    <td>{{ $evaluationEleve->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection