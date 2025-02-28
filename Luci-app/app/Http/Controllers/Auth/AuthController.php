<?php

namespace App\Http\Controllers\Auth;

use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'Firstname' => 'required',
                'Lastname' => 'required',
                'phonenumber' => 'required',
                'city' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'gender' => 'required|string',

            ]);
            $verification_code = rand(100000, 999999); // Generate a 6-digit code
            $user = User::create([
                'Firstname' => $validated['Firstname'],
                'Lastname' => $validated['Lastname'],
                'phonenumber' => $validated['phonenumber'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'city' => $validated['city'],
                'gender' => $validated['gender'],
                'verification_code' => $verification_code
            ]);

            // Send verification code via email
            Mail::to($user->email)->send(new VerifyEmail($verification_code));
            // Generate token
            $token = $user->createToken('auth_token')->plainTextToken;


            return redirect('/')->with('success', 'Registration successful!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Validation failed! Please check the errors below.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            $user = User::where('email', $validated['email'])->first();

            if (!$user) {
                return redirect()->back()->withErrors(['email' => 'The email address is not registered.'])->withInput();
            }

            if (!Hash::check($validated['password'], $user->password)) {
                return redirect()->back()->withErrors(['password' => 'Incorrect password.'])->withInput();
            }

            // Generate token
            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect('/')->with('success', 'Login successful!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function verifyCode(Request $request)
    {
        // Ensure the verification code is exactly 6 digits and is numeric
        $request->validate([
            'code' => 'required|numeric|digits:6', // Validate as a 6-digit number
        ]);
    
        // Find the user by the verification code
        $user = User::where('verification_code', $request->code)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid verification code.');
        }
    
        // Update the user to mark the email as verified
        // $user->email_verified_at = now();
        // $user->verification_code = null; // Clear the verification code
        $user->save();
    
        return redirect('/')->with('success', 'Email verified successfully! You can now log in.');
    }
    


    // public function verifycode()
    // {
    //     return redirect('/')->with('success', 'register successful!');
    // }


    public function displayVerifycode()
    {
        return view('Email.verify');
    }

    public function forgetPassword()
    {
        return view('Auth.emailCode');
    }

    public function createPassword()
    {
        return view('Auth.createpassword');
    }

    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    public function displayLogin()
    {
        return view('Auth.login');
    }

    public function displayForgetPW()
    {
        return view('Auth.forgetpw');
    }
}
