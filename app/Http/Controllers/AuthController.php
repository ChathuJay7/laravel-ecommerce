<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $req){
        $user = User::where(['email'=>$req->email])->first();

        if(!$user || !Hash::check($req->password, $user->password))
        {
            return "Username or Password invalid!";
        }
        else
        {
            $req->session()->put('user', $user);
            return redirect('/');
        }
    }

    // function register(Request $req){

    //     //input validation
    //     // $fields = $req->validate([

    //     //     'name' => 'required|string',
    //     //     'email' => 'required|string|unique',
    //     //     'password' => 'required|string',

    //     // ]);

    //     $user = new User;
    //     $user->name = $req->name;
    //     $user->email = $req->email;
    //     $user->role = 'user';
    //     $user->password = Hash::make($req->password);
    //     $user->save();

    //     $response = [
    //         'message' => "Registered successfully",
    //     ];

    //     return redirect('/login');

    //     // try {

    //     //     //create new student
    //     //     $user = User::create([
    //     //         'name' => $fields['name'],
    //     //         'email' => $fields['email'],
    //     //         'role' => 'user',
    //     //         'password' => Hash::make($fields['gender']),
    //     //     ]);

    //     //     $response = [
    //     //         'message' => "Registered successfully",
    //     //     ];

    //     //     return redirect('/login', $response);

    //     // } catch (Exception $exception) {

    //     //     $response = [
    //     //         'message' => 'something went wrong',
    //     //         'error' => $exception
    //     //     ];

    //     //     return response($response);
    //     // }

    // }



    function register(Request $req){
        try {
            // Validate input
            $req->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);
    
            // Create a new User instance
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->role = 'user';
            $user->password = Hash::make($req->password);
            $user->save();
    
            // Registration successful
            $response = [
                'message' => "Registered successfully",
            ];
    
            return redirect('/login')->with($response);
        } catch (\Exception $e) {
            // Registration failed
            $response = [
                'message' => "Registration failed. Please try again.",
                'error' => $e->getMessage(),
            ];
    
            return redirect()->back()->withErrors($response);
        }
    }
}
