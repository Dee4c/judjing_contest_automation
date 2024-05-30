<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:5|max:12',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role = 'judge'; // Assign the role 'judge' to the user
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
            'edit_password' => 'required|min:5|max:12',
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

    public function candidateDashboard()
    {
        return view('usermanage.candidate_dash');
    }
}
