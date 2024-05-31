<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CandidateController extends Controller
{
    public function create()
    {
        return view('candidates.create');
    }

    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'candidateNumber' => 'required|unique:candidates',
            'candidateName' => 'required',
            'age' => 'required',
            'candidateAddress' => 'required',
            'candidateStatistics' => 'required',
            // Add validation rules for other attributes as needed
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Candidate::create([
            'candidateNumber' => $request->candidateNumber,
            'candidateName' => $request->candidateName,
            'age' => $request->age,
            'candidateAddress' => $request->candidateAddress,
            'candidateStatistics' => $request->candidateStatistics,
            // Add other attributes as needed
        ]);

        Session::flash('success', 'Candidate added successfully');

        return redirect()->route('usermanage.candidate_dash')->with('success', 'Candidate added successfully');
    }
    // Implement other methods for updating, deleting, etc.
}
