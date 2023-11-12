<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    function login(Request $req){

        try {
            // Validate input
            $req->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
    
            $user = User::where(['email'=>$req->email])->first();

            if(!$user || !Hash::check($req->password, $user->password))
            {
                $error = "Login Failed. Invalid details";
                return view('login', compact('error'));
            }
            else
            {
                $req->session()->put('user', $user);
                return redirect('/');
            }

        } catch (Exception $e) {
            // Registration failed
            $response = [
                'message' => "Login failed. Please try again.",
            ];
    
            return redirect()->back()->withErrors($response);
        }

    }


    function register(Request $req){
        try {
            // Validate input
            $req->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);
    
            // Create a new User instance
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->role = 'user';
            $user->password = Hash::make($req->password);
            $user->save();
    
            // Registration successful
            return redirect('/login');

        } catch (Exception $e) {
            // Registration failed
            $response = [
                'message' => "Registration failed. Please try again.",
                'error' => $e->getMessage(),
            ];
    
            return redirect()->back()->withErrors($response);
        }
    }

}
