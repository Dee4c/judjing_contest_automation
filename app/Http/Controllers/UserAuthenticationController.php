<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Database\Seeders\AdminUserSeeder; // Import the AdminUserSeeder

class UserAuthenticationController extends Controller
{
    public function login()
    {
        // Check if the user is already logged in
        if (Session::has('loginId')) {
            $userId = Session::get('loginId');
            $user = User::find($userId);
    
            // Redirect to the appropriate dashboard based on user's role
            if ($user && $user->username === 'admin') {
                return redirect()->route('usermanage.dashboard');
            } else {
                return redirect('./login');
            }
        } else {
            // If not logged in, show the login page
            return view("auth.login");
        }
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
            if ($user->username === 'admin' && $request->password === $user->password) {
                // If the user is admin and password matches, redirect to admin dashboard
                $request->session()->put('loginId', $user->id);
                return redirect('usermanage/dashboard');
            } elseif ($request->password === $user->password) {
                // For other users, if password matches, redirect to judge dashboard
                $request->session()->put('loginId', $user->id);
                return redirect('judge/judgeDashboard');
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
        Session::forget('loginId'); // Remove 'loginId' from session
        return redirect('login'); // Redirect to the login page after logout
    }

    public function judgeDashboard(){
        return view('judge.judge_dashboard');
    }
    
    
}

