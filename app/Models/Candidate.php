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

    // Define the relationship with the Score model
    // public function scores()
    // {
    //     return $this->hasMany(Score::class, 'candidate_number', 'candidateNumber');
    // }

    // Define the relationship with the SwimSuitScore model
    public function swimSuitScores()
    {
        return $this->hasMany(SwimSuitScore::class, 'candidate_number', 'candidateNumber');
    }

    // Define the relationship with the GownScore model
    public function gownScores()
    {
        return $this->hasMany(GownScore::class, 'candidate_number', 'candidateNumber');
    }

    // Define a method to calculate the pre-interview average score
    public function preInterviewAverageScore()
    {
        // Retrieve the scores given by the judge for the pre-interview category
        $preInterviewScores = $this->scores()
            ->where('composure', '!=', null)
            ->where('poise_grace_projection', '!=', null)
            ->where('judge_name', '!=', null)
            ->get();

        // Calculate the average score
        $totalScore = 0;
        foreach ($preInterviewScores as $score) {
            $totalScore += ($score->composure + $score->poise_grace_projection) / 2;
        }

        $averageScore = count($preInterviewScores) > 0 ? $totalScore / count($preInterviewScores) : 0;

        // Round the average score and return it
        return round($averageScore);
    }

    // Define a method to calculate the swim suit average score
    public function swimSuitAverageScore()
    {
        // Retrieve the swim suit scores given by the judge
        $swimSuitScores = $this->swimSuitScores()
            ->where('composure', '!=', null)
            ->where('poise_grace_projection', '!=', null)
            ->where('judge_name', '!=', null)
            ->get();

        // Calculate the average score
        $totalScore = 0;
        foreach ($swimSuitScores as $score) {
            $totalScore += ($score->composure + $score->poise_grace_projection) / 2;
        }

        $averageScore = count($swimSuitScores) > 0 ? $totalScore / count($swimSuitScores) : 0;

        // Round the average score and return it
        return round($averageScore);
    }

    // Define a method to calculate the gown average score
    public function gownAverageScore()
    {
        // Retrieve the gown scores given by the judge
        $gownScores = $this->gownScores()
            ->where('suitability', '!=', null)
            ->where('poise_grace_projection', '!=', null)
            ->where('judge_name', '!=', null)
            ->get();

        // Calculate the average score
        $totalScore = 0;
        foreach ($gownScores as $score) {
            $totalScore += ($score->suitability + $score->poise_grace_projection) / 2;
        }

        $averageScore = count($gownScores) > 0 ? $totalScore / count($gownScores) : 0;

        // Round the average score and return it
        return round($averageScore);
    }
}
