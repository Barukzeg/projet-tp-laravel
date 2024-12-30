<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Module;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluations = Evaluation::all();

        return view('evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new evaluation.
     */
    public function create()
    {
        // Récupère tous les modules de la base de données
        $modules = Module::all();

        // Retourne la vue de création avec la liste des modules
        return view('evaluations.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'coefficient' => 'required|numeric',
            'module_id' => 'required|exists:modules,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Evaluation::create($validator->validated());

        return redirect()->route('evaluations.index')->with('success', 'Évaluation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evaluation = Evaluation::findOrFail($id);

        return view('evaluations.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $modules = Module::all();

        return view('evaluations.edit', compact('evaluation', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'coefficient' => 'required|numeric',
            'module_id' => 'required|exists:modules,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $evaluation = Evaluation::findOrFail($id);
        $evaluation->update($validator->validated());

        return redirect()->route('evaluations.index')->with('success', 'Évaluation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();

        return redirect()->route('evaluations.index')->with('success', 'Évaluation supprimée avec succès.');
    }
}
