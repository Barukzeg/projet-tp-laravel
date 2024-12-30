<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupère tous les modules de la base de données
        $modules = Module::all();

        // Retourne la vue d'index avec la liste des modules
        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: 'modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valide les données du formulaire
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:10|unique:modules,code',
            'nom' => 'required|string|max:255',
            'coefficient' => 'required|numeric',
        ]);

        // Si la validation échoue, retourne avec les erreurs et les entrées utilisateur
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Si la validation réussit, crée un nouvel module
        Module::create($validator->validated());

        // Redirige vers la liste des modules avec un message de succès
        return redirect()->route('modules.index')->with('success', 'Module créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupère le module par son ID
        $module = Module::findOrFail($id);

        // Retourne la vue des détails de le module
        return view('modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupère le module par son ID
        $module = Module::findOrFail($id);

        // Retourne la vue d'édition avec les données de le module
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récupère le module par son ID
        $module = Module::findOrFail($id);

        // Valide les données du formulaire
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:10|unique:modules,code,' . $module->id,
            'nom' => 'required|string|max:255',
            'coefficient' => 'required|numeric',
        ]);

        // Si la validation échoue, retourne avec les erreurs et les données entrées
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Si la validation réussit, met à jour le module avec les données validées
        $module->update($validator->validated());

        // Redirige vers la liste des modules avec un message de succès
        return redirect()->route('modules.index')->with('success', 'Module mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupère le module par son ID et le supprime
        $module = Module::findOrFail($id);
        $module->delete();

        // Redirige vers la liste des modules avec un message de succès
        return redirect()->route('modules.index')->with('success', 'Module supprimé avec succès.');
    }
}
