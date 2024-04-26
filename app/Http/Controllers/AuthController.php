<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registerSave(Request $request){

        if ($request->hasFile('image')) {
            // Upload image
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('carscontainer', $imageName, 'public'); // Adjust the storage path as needed
        }


        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'annual_income' => 'required',
            'password' => 'required|min:8',
        ]);
        
        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'gender' => $validatedData['gender'],
            'annual_income' => $validatedData['annual_income'],
            'password' => Hash::make($validatedData['password']),
            'image' => $imageName,
            'role' => 'customer',
        ]);
        
        // Attempt to log in the user
        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            // If login is successful, regenerate the session
            $request->session()->regenerate();
        
            // Redirect the user to the home page
            return redirect()->route('home');
        } else {
            // If login fails, handle it accordingly
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
        
        
    }



    public function loginAction(Request $request){

        Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }


    



    
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('home');
    }


}
