<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Candidate;
use App\Models\Score;
use App\Models\GownScore;
use App\Models\SwimSuitScore;


class UserManagementController extends Controller
{
    public function addJudgeForm()
    {
        return view('usermanage.add_judge');
    }

    public function addJudge(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role = 'judge';
        $user->save();

        Session::flash('success', 'Judge added successfully');

        return redirect()->route('usermanage.dashboard')->with('success', 'Judge added successfully');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_username' => 'required',
            'edit_password' => 'required',
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->name = $request->edit_name;
        $user->username = $request->edit_username;
        $user->password = $request->edit_password;
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function createCandidate()
    {
        return view('candidates.create');
    }

    public function storeCandidate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidateNumber' => 'required|unique:candidates',
            'candidateName' => 'required',
            'age' => 'required|numeric',
            'candidateAddress' => 'required',
            'waist' => 'required|numeric', // Add validation for waist
            'hips' => 'required|numeric', // Add validation for hips
            'chest' => 'required|numeric', // Add validation for chest
            'candidateImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file types and size
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $candidate = new Candidate();
        $candidate->candidateNumber = $request->candidateNumber;
        $candidate->candidateName = $request->candidateName;
        $candidate->age = $request->age;
        $candidate->candidateAddress = $request->candidateAddress;
        $candidate->waist = $request->waist; // Assign waist value
        $candidate->hips = $request->hips; // Assign hips value
        $candidate->chest = $request->chest; // Assign chest value
    
        // Handle image upload
        if ($request->hasFile('candidateImage')) {
            $image = $request->file('candidateImage');
            if ($image->isValid()) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName); // Move the image to the public/images directory
                $candidate->candidateImage = 'images/' . $imageName; // Save the image path in the database
            } else {
                return back()->withErrors(['candidateImage' => 'Invalid image file'])->withInput();
            }
        }
    
        $candidate->save();
    
        return redirect()->route('usermanage.candidate_dash')->with('success', 'Candidate added successfully');
    }
    
    public function candidateDash()
    {
        $candidates = Candidate::all();
        return view('usermanage.candidate_dash', compact('candidates'));
    }

        // Add this method to handle deleting a candidate
    public function deleteCandidate($id)
    {
        $candidate = Candidate::find($id);

        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidate not found');
        }

        $candidate->delete();

        return redirect()->back()->with('success', 'Candidate deleted successfully');
    }

        public function updateCandidate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'candidateNumber' => 'required|unique:candidates,candidateNumber,' . $id,
            'candidateName' => 'required',
            'age' => 'required|numeric',
            'candidateAddress' => 'required',
            'waist' => 'required|numeric',
            'hips' => 'required|numeric',
            'chest' => 'required|numeric',
            'candidateImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file types and size
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $candidate = Candidate::find($id);
        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidate not found');
        }

        $candidate->candidateNumber = $request->candidateNumber;
        $candidate->candidateName = $request->candidateName;
        $candidate->age = $request->age;
        $candidate->candidateAddress = $request->candidateAddress;
        $candidate->waist = $request->waist;
        $candidate->hips = $request->hips;
        $candidate->chest = $request->chest;

        // Handle image upload
        if ($request->hasFile('candidateImage')) {
            $image = $request->file('candidateImage');
            if ($image->isValid()) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName); // Move the image to the public/images directory
                $candidate->candidateImage = 'images/' . $imageName; // Save the image path in the database
            } else {
                return back()->withErrors(['candidateImage' => 'Invalid image file'])->withInput();
            }
        }

        $candidate->save();

        return redirect()->route('usermanage.candidate_dash')->with('success', 'Candidate updated successfully');
    }

    public function preliminaryDash()
    {
        // Fetch all candidates with their associated scores
        $candidates = Candidate::with('scores')->get();
        
        // Pass candidate data to the view
        return view('usermanage.preliminary_dash', ['candidates' => $candidates]);
    }

    

    public function judgeDashboard()
    {
        // Fetch all candidates
        $candidates = Candidate::all();
        
        // Pass candidate data to the view
        return view('judge.judge_dashboard', ['candidates' => $candidates]);
    }

    
    public function storeScore(Request $request)
    {
        $request->validate([
            'candidate_number' => 'required|array',
            'composure' => 'required|array',
            'poise_grace_projection' => 'required|array',
            'judge_name' => 'required|array',
            'composure.*' => 'required|integer|min:0|max:50',
            'poise_grace_projection.*' => 'required|integer|min:0|max:50',
            'judge_name.*' => 'required|string|max:255',
        ]);
    
        $candidateNumbers = $request->input('candidate_number');
        $composures = $request->input('composure');
        $poiseGraceProjections = $request->input('poise_grace_projection');
        $judgeNames = $request->input('judge_name');
    
        $scores = [];
    
        foreach ($candidateNumbers as $key => $candidateNumber) {
            $scores[] = [
                'candidate_number' => $candidateNumber,
                'composure' => $composures[$key],
                'poise_grace_projection' => $poiseGraceProjections[$key],
                'judge_name' => $judgeNames[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        Score::insert($scores);
    
        return redirect()->back()->with('success', 'Scores added successfully');
    }

    public function storeSwimSuitScore(Request $request)
    {
        $request->validate([
            'candidate_number' => 'required|array',
            'composure' => 'required|array',
            'poise_grace_projection' => 'required|array',
            'judge_name' => 'required|array',
            'composure.*' => 'required|integer|min:0|max:50',
            'poise_grace_projection.*' => 'required|integer|min:0|max:50',
            'judge_name.*' => 'required|string|max:255',
        ]);
    
        $candidateNumbers = $request->input('candidate_number');
        $composures = $request->input('composure');
        $poiseGraceProjections = $request->input('poise_grace_projection');
        $judgeNames = $request->input('judge_name');
    
        $scores = [];
    
        foreach ($candidateNumbers as $key => $candidateNumber) {
            $scores[] = [
                'candidate_number' => $candidateNumber,
                'composure' => $composures[$key],
                'poise_grace_projection' => $poiseGraceProjections[$key],
                'judge_name' => $judgeNames[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        SwimSuitScore::insert($scores);
    
        return redirect()->back()->with('success', 'Scores added successfully');
    }
    

        public function storeGownScore(Request $request)
    {
        $request->validate([
            'candidate_number' => 'required|array',
            'suitability' => 'required|array',
            'poise_grace_projection' => 'required|array',
            'judge_name' => 'required|array',
            'suitability.*' => 'required|integer|min:0|max:50',
            'poise_grace_projection.*' => 'required|integer|min:0|max:50',
            'judge_name.*' => 'required|string|max:255',
        ]);

        $candidateNumbers = $request->input('candidate_number');
        $suitabilities = $request->input('suitability');
        $poiseGraceProjections = $request->input('poise_grace_projection');
        $judgeNames = $request->input('judge_name');

        $gownScores = [];

        foreach ($candidateNumbers as $key => $candidateNumber) {
            $gownScores[] = [
                'candidate_number' => $candidateNumber,
                'suitability' => $suitabilities[$key],
                'poise_grace_projection' => $poiseGraceProjections[$key],
                'judge_name' => $judgeNames[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        GownScore::insert($gownScores);

        return redirect()->back()->with('success', 'Gown scores added successfully');
    }
        public function semifinalsDashboard()
    {
        $candidates = Candidate::all();
        
        // Pass candidate data to the view
        return view('judge.semi_finals_dash', ['candidates' => $candidates]);
    }

} 


