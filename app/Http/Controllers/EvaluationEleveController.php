<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvaluationEleve;
use App\Models\Evaluation;
use App\Models\Eleve;
use Illuminate\Support\Facades\Validator;

class EvaluationEleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluationEleves = EvaluationEleve::all();

        return view('evaluationEleves.index', compact('evaluationEleves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $evaluations = Evaluation::all();
        $eleves = Eleve::all();

        return view('evaluationEleves.create', compact('evaluations', 'eleves'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required|numeric',
            'evaluation_id' => 'required|exists:evaluations,id',
            'eleve_id' => 'required|exists:eleves,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        EvaluationEleve::create($validator->validated());

        return redirect()->route('evaluationEleves.index')->with('success', 'Note créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evaluationEleve = EvaluationEleve::findOrFail($id);

        return view('evaluationEleves.show', compact('evaluationEleve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evaluationEleve = EvaluationEleve::findOrFail($id);
        $evaluations = Evaluation::all();
        $eleves = Eleve::all();

        return view('evaluationEleves.edit', compact('evaluationEleve', 'evaluations', 'eleves'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required|numeric',
            'evaluation_id' => 'required|exists:evaluations,id',
            'eleve_id' => 'required|exists:eleves,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $evaluationEleve = EvaluationEleve::findOrFail($id);
        $evaluationEleve->update($validator->validated());

        return redirect()->route('evaluationEleves.index')->with('success', 'Note modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evaluationEleve = EvaluationEleve::findOrFail($id);
        $evaluationEleve->delete();

        return redirect()->route('evaluationEleves.index')->with('success', 'Note supprimée avec succès.');
    }

    /**
     * Find all notes from an evaluation.
     */
    public function notesEval(string $evaluation_id){
        $evaluationEleves = EvaluationEleve::where('evaluation_id', $evaluation_id)->get();

        return view('evaluationEleves.notesEval', compact('evaluationEleves'));
    }

    /**
     * Find all notes from an eleve.
     */
    public function notesEleve(string $eleve_id)
    {
        $evaluationEleves = EvaluationEleve::where('eleve_id', $eleve_id)->get();
        
        $totalNotes = 0;
        $totalCoefficients = 0;
    
        foreach ($evaluationEleves as $evaluationEleve) {
            $note = $evaluationEleve->note;
            $coefficient = $evaluationEleve->evaluation->coefficient;
    
            $totalNotes += $note * $coefficient;
            $totalCoefficients += $coefficient;
        }
    
        $moyenne = $totalCoefficients > 0 ? $totalNotes / $totalCoefficients : null;
    
        return view('evaluationEleves.notesEleve', compact('evaluationEleves', 'moyenne'));
    }

    /**
     * Find all notes from an evaluation, under the average (10/20).
     */
    public function notesFailed(string $evaluation_id){

        $evaluation = EvaluationEleve::where('evaluation_id', $evaluation_id)->get();

        $notes = $evaluation->filter(function ($evaluationEleve) {
            return $evaluationEleve->note < 10;
        });

        return view('evaluationEleves.notesFailed', compact('evaluation', 'notes'));
    }
}
