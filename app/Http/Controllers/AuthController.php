<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // function login(Request $req){

    //     try {
    //         // Validate input
    //         $req->validate([
    //             'email' => 'required',
    //             'password' => 'required',
    //         ]);
    
    //         $user = User::where(['email'=>$req->email])->first();

    //         if(!$user || !Hash::check($req->password, $user->password))
    //         {
    //             $error = "Login Failed. Invalid details";
    //             return view('login', compact('error'));
    //         }
    //         else
    //         {
    //             $req->session()->put('user', $user);
                
    //             if ($user->role === 'user') {
    //                 return redirect('/home');
    //             } elseif ($user->role === 'admin') {
    //                 return redirect('/admin-dashboard');
    //             }
    //             // if ($user->role === 'admin') {
    //             //     return redirect('/admin-dashboard');
    //             // } elseif ($user->role === 'user') {
    //             //     return redirect('/home');
    //             // }
    //         }

    //     } catch (Exception $e) {
    //         // Registration failed
    //         $response = [
    //             'message' => "Login failed. Please try again.",
    //         ];
    
    //         return redirect()->back()->withErrors($response);
    //     }

    // }


    // function login(Request $req){
    //     try {
    //         // Validate input
    //         $req->validate([
    //             'email' => 'required|email',
    //             'password' => 'required',
    //         ]);
    
    //         // Attempt to authenticate the user
    //         $credentials = $req->only('email', 'password');
    //         if (Auth::attempt($credentials)) {
    //             // Authentication successful
    //             return redirect('/home');
    //         } else {
    //             // Authentication failed
    //             $error = "Login Failed. Invalid details";
    //             return view('login', compact('error'));
    //         }
    //     } catch (Exception $e) {
    //         // Handle exceptions
    //         $response = [
    //             'message' => "Login failed. Please try again.",
    //         ];
    //         return redirect()->back()->withErrors($response);
    //     }
    // }




    /**
     * Attempt to log in the user.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    function login(Request $req){
        try {
            // Validate input
            $req->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            // Attempt to authenticate the user
            $credentials = $req->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // Authentication successful
                $user = Auth::user();
    
                // Check the role and redirect accordingly
                if ($user->role === 'user') {
                    return redirect('/home');
                } elseif ($user->role === 'admin') {
                    return redirect('/admin-dashboard');
                }
            } else {
                // Authentication failed
                $error = "Login Failed. Invalid details";
                return view('login', compact('error'));
            }
        } catch (Exception $e) {
            // Handle exceptions
            $response = [
                'message' => "Login failed. Please try again.",
            ];
            return redirect()->back()->withErrors($response);
        }
    }
    

    /**
     * Handle the user registration process.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
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



    /**
     * Handle the user logout process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function logout(Request $request)
    {
        // Logout the user
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }



    /**
     * Display the login page.
     *
     * @return \Illuminate\View\View
     */
    function loginPage() {
        return view('login');
    }


    /**
     * Display the register page.
     *
     * @return \Illuminate\View\View
     */
    function registerPage() {
        return view('register');
    }

}
