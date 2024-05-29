<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Database\Seeders\AdminUserSeeder; // Import the AdminUserSeeder

class UserAuthenticationController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:5|max:12',
        ]);

        // Check if the admin user exists
        $adminUser = User::where('username', 'admin')->first();
        if (!$adminUser) {
            // If admin user doesn't exist, run the seeder
            $seeder = new AdminUserSeeder();
            $seeder->run();
        }

        $user = User::where('username', $request->username)->first();

        if ($user) {
            if ($user->username === 'admin' && Hash::check($request->password, $user->password)) {
                // If the user is admin and password matches, redirect to admin dashboard
                $request->session()->put('loginId', $user->id);
                return redirect('usermanage/dashboard');
            } elseif (Hash::check($request->password, $user->password)) {
                // For other users, if password matches, redirect to judge dashboard
                $request->session()->put('loginId', $user->id);
                return redirect('judge/dashboard');
            } else {
                // Flash error message for incorrect password
                Session::flash('fail', 'Password does not match');
                return back()->with('fail', 'Password does not match');
            }
        } else {
            // Flash error message for unregistered username
            Session::flash('fail', 'This username is not registered');
            return back()->with('fail', 'This username is not registered');
        }
    }

    public function dashboard()
    {
        $users = User::where('username', '!=', 'admin')->get();
        return view('usermanage.dashboard', compact('users'));
    }
    

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::forget('loginId'); // Remove 'loginId' from session
        }
        return redirect('login'); // Redirect to the login page after logout
    }
    
    public function deleteUser($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            // Handle case where user is not found
            return redirect()->back()->with('error', 'User not found');
        }

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}

