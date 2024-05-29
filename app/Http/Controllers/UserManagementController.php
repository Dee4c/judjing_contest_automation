<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; // Import Validator
use Illuminate\Support\Facades\Session;


class UserManagementController extends Controller
{
    public function addJudgeForm()
    {
        return view('usermanage.add_judge');
    }

    public function addJudge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required|min:5|max:12',
            // Add any other validation rules as needed
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        // Assign the role 'judge' to the user
        $user->role = 'judge';
        $user->save();

        // Flash success message
        Session::flash('success', 'Judge added successfully');

        // Redirect to a success page or wherever you want
        return redirect()->route('addJudgeForm')->with('success', 'Judge added successfully');
    }
}
