@extends('layouts.app')

@section('title', 'Notes de l\'évaluation en dessous de la moyenne')

@section('content')
    <h1>Notes de l'évaluation en dessous de la moyenne</h1>

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
            @foreach($notes as $note)
                <tr>
                    <td>{{ $note->eleve->nom }} {{ $note->eleve->prenom }}</td>
                    <td>{{ $note->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection