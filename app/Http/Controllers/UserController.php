<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    /**
     * Display a listing of the users in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    function adminUserView() {
        $users = User::all();
        return view('/admin-user', compact('users'));
    }



    /**
     * Display the form for adding a new user in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    function addNewUserView() {
        return view('/add-new-user');
    }



    /**
     * Handle the request to add a new user in the admin panel.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\RedirectResponse
     */
    function addNewUser(Request $req) {
        try {
            // Validate input
            $req->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'role' => 'required|string',
            ]);
    
            // Create a new User instance
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->role = $req->role;
            $user->password = Hash::make("abcd1234");
            $user->save();
    
            // Registration successful
            return redirect('/admin-user');

        } catch (Exception $e) {
            // Registration failed
            $response = [
                'message' => "Failed to add User. Please try again.",
                'error' => $e->getMessage(),
            ];
    
            return redirect()->back()->withErrors($response);
        }
    }



    /**
     * Display the form to update user information in the admin panel.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function updateUserView($id){
        // Retrieve the product by ID
        $user = User::find($id);

        return view('admin-update-user', compact('user'));
    }



    /**
     * Update the role of a user in the admin panel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserAdmin(Request $request, $id)
    {
        try {
            // Validate input
            $request->validate([
                'role' => 'required|string',
            ]);

            // Find the user by ID
            $user = User::findOrFail($id);

            // Update the role
            $user->role = $request->role;
            $user->save();

            // Update successful
            return redirect('/admin-user')->with('success', 'User role updated successfully.');

        } catch (Exception $e) {
            // Update failed
            $response = [
                'message' => "Failed to update user role. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }



    /**
     * Delete a user in the admin panel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id)
    {
        try {
            // Find the product by ID
            $user = User::find($id);

            // If the product is found, delete it
            if ($user) {
                $user->delete();
                return redirect('/admin-user')->with('success', 'User deleted successfully');
            } else {
                // Product not found
                return redirect('/admin-user')->with('error', 'User not found');
            }
        } catch (Exception $e) {
            // Handle exceptions
            return redirect('/admin-user')->with('error', 'Failed to delete user. Please try again.');
        }
    }


    /**
     * Display the form to update user details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function updateUserDetailsView($id){
        // Retrieve the product by ID
        $user = User::find($id);

        // Pass the product data to the view
        return view('update-user-details', compact('user'));
    }



    /**
     * Update the user details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserDetails(Request $request, $id)
    {

        try {
            // Validate input
            $request->validate([
                'name' => 'required|string',
            ]);

            // Find the user by ID
            $user = User::findOrFail($id);

            // Update the name
            $user->name = $request->name;
            $user->save();

            // Update successful
            return redirect('/update-user-details/' . $user->id)->with('success', 'User details updated successfully.');


        } catch (Exception $e) {
            // Update failed
            $response = [
                'message' => "Failed to update details. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }



    /**
     * Display the form to update the user's password.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function updateUserPasswordView($id){
        // Retrieve the product by ID
        $user = User::find($id);

        return view('update-user-password', compact('user'));
    }

 

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserPassword(Request $request, $id)
    {

        try {
            // Validate input
            $request->validate([
                'oldPassword' => 'required|string',
                'password' => 'required|confirmed|min:6',
            ]);

            $user = User::find($id);

            // Check if the old password matches
            if (!Hash::check($request->oldPassword, $user->password)) {
                return back()->withInput()->withErrors(['oldPassword' => 'The old password is incorrect.']);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            // Update successful
            return redirect('/update-user-password/' . $user->id)->with('success', 'Password updated successfully.');


        } catch (Exception $e) {
            // Update failed
            $response = [
                'message' => "Failed to update password. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }



    /**
     * Perform a search for users based on the provided search term.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        try {
            // Get the search query from the request
            $query = $request->input('searchTerm');

            // Perform a basic search on the user name
            $users = User::where('name', 'like', '%' . $query . '%')->get();
            
            // Check the user's role
            return view('admin-user', compact('users'));

        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'message' => "Failed to perform the search. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }



    public function userDetails($id)
    {
        try {
            // Get the user by ID
            $user = User::findOrFail($id);

            // Get the user's orders
            $orders = Order::where('user_id', $user->id)->get();

            return view('admin-single-user', compact('user', 'orders'));
        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'message' => "Failed to retrieve user details. Please try again.",
                'error' => $e->getMessage(),
            ];

            return redirect()->back()->withErrors($response);
        }
    }

}
