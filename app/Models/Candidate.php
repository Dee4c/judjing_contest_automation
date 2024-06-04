<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidateName',
        'candidateNumber',
        'age',
        'candidateAddress',
        'candidateStatistics',
    ];
    
    public function scores()
    {
        return $this->hasMany(Score::class, 'candidate_number', 'candidateNumber');
    }
}