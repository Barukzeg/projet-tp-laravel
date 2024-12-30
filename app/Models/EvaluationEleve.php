<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationEleve extends Model
{
    use HasFactory;

    protected $table = 'evaluation_eleves';

    protected $fillable = [
        'note',
        'evaluation_id',
        'eleve_id',
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }
}
