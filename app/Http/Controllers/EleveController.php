<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EleveController extends Controller
{
    /**
     * Affiche une liste de tous les élèves.
     */
    public function index()
    {
        // Récupère tous les élèves de la base de données
        $eleves = Eleve::all();

        // Retourne la vue d'index avec la liste des élèves
        return view('eleves.index', compact('eleves'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel élève.
     */
    public function create()
    {
        return view('eleves.create');
    }

    /**
     * Stocke un nouvel élève dans la base de données.
     */
    public function store(Request $request)
    {
        // Valide les données du formulaire
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'numero_etudiant' => 'required|string|max:10|unique:eleves,numero_etudiant',
            'email' => 'required|string|max:255|unique:eleves,email',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Si la validation échoue, retourne avec les erreurs et les entrées utilisateur
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Si la validation réussit, crée un nouvel élève
        Eleve::create($validator->validated());

        // Redirige vers la liste des élèves avec un message de succès
        return redirect()->route('eleves.index')->with('success', 'Élève créé avec succès.');
    }

    /**
     * Affiche les détails d'un élève spécifique.
     */
    public function show($id)
    {
        // Récupère l'élève par son ID
        $eleve = Eleve::findOrFail($id);

        // Retourne la vue des détails de l'élève
        return view('eleves.show', compact('eleve'));
    }

    /**
     * Affiche le formulaire d'édition d'un élève.
     */
    public function edit($id)
    {
        // Récupère l'élève par son ID
        $eleve = Eleve::findOrFail($id);

        // Retourne la vue d'édition avec les données de l'élève
        return view('eleves.edit', compact('eleve'));
    }

    /**
     * Met à jour les informations d'un élève dans la base de données.
     */
    public function update(Request $request, $id)
    {
        // Récupère l'élève par son ID
        $eleve = Eleve::findOrFail($id);

        // Valide les données du formulaire
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'numero_etudiant' => 'required|string|max:10|unique:eleves,numero_etudiant,' . $id,
            'email' => 'required|string|max:255|unique:eleves,email,' . $id,
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Si la validation échoue, retourne avec les erreurs et les données entrées
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Si une nouvelle image est téléchargée, la stocke et met à jour le chemin de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $eleve->image = $imagePath;
        }

        // Met à jour l'élève avec les autres données validées
        $eleve->update($validator->validated());

        // Redirige vers la liste des élèves avec un message de succès
        return redirect()->route('eleves.index')->with('success', 'Élève mis à jour avec succès.');
    }

    /**
     * Supprime un élève de la base de données.
     */
    public function destroy($id)
    {
        // Récupère l'élève par son ID et le supprime
        $eleve = Eleve::findOrFail($id);
        $eleve->delete();

        // Redirige vers la liste des élèves avec un message de succès
        return redirect()->route('eleves.index')->with('success', 'Élève supprimé avec succès.');
    }
}
