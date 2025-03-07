<?php

namespace App\Http\Controllers\Auth;

use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Str;
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

            // Redirect to verification page with email
            return redirect()->route('verify.code')->with([
                'success' => 'Registration successful! Please enter the verification code sent to your email.',
                'email' => $user->email
            ]);
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

            // // Generate token
            // $token = $user->createToken('auth_token')->plainTextToken;

            return redirect('/')->with('success', 'Login successful!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function verifyCode(Request $request)
    {
        // Ensure the verification code is exactly 6 digits and numeric
        $request->validate([
            'code' => 'required|numeric|digits:6', // Validate as a 6-digit number
        ]);

        // Find the user by the verification code
        $user = User::where('verification_code', $request->code)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['code' => 'Invalid verification code. Please try again.']);
        }

        // Check if the user is already verified
        if ($user->email_verified_at) {
            return redirect('/')->with('success', 'Your email is already verified. You can log in.');
        }

        // Mark the user as verified
        $user->email_verified_at = now();
        // $user->verification_code = null;
        $user->save();

        return redirect('/')->with('success', 'Email verified successfully! You can now log in.');
    }




    // public function verifycode()
    // {
    //     return redirect('/')->with('success', 'register successful!');
    // }
    
        
        
       

    public function verifyResetCode(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);
    
        $user = User::where('reset_code', $request->code)->first();
    
        if (!$user) {
            return redirect()->back()->withErrors(['code' => 'Invalid or expired reset code.']);
        }
    
        // Clear the reset code after successful verification
        $user->update([
            'reset_code' => null,
        ]);
    
        return redirect()->route('Auth.createpassword', ['email' => $user->email])
            ->with('success', 'Code verified! Set your new password.');
    }
    
    
    
        // // Display reset password form
        // public function displayResetPasswordForm(Request $request)
        // {
        //     return view('Auth.createpassword', ['email' => $request->email]);
        // }
    
        public function createPassword(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6|confirmed',
            ]);
        
            $user = User::where('email', $request->email)->first();
        
            if (!$user) {
                return redirect()->back()->withErrors(['email' => 'Invalid request.']);
            }
        
            // Update password and clear reset fields
            $user->update([
                'password' => Hash::make($request->password),
                'reset_code' => null,
                'reset_code_expires_at' => null
            ]);
        
            return redirect('/')->with('success', 'Password reset successful! You can now log in.');
        }
        
        
        
        
    
        public function forgetPassword(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
        
            $user = User::where('email', $request->email)->first();
        
            $reset_code = rand(100000, 999999);
            $user->reset_code = $reset_code;
            $user->save();
        
            Mail::to($user->email)->send(new ResetPasswordMail($reset_code));
        
            return redirect()->route('password.verify')->with([
                'success' => 'A password reset code has been sent to your email.',
                'email' => $user->email
            ]);
        }
        
    
    

    public function displayVerifycode()
    {
        return view('Email.verify');
    }

    // public function forgetPassword()
    // {
    //     return view('Auth.emailCode');
    // }


    // Display forget password form
    public function displayForgetPasswordForm()
    {
        return view('Auth.forgetpw');
        // return view('Auth.emailCode');
    }

    // Display verify code form
    public function displayVerifyResetCodeForm()
    {
        return view('Auth.verifyCode');
    }
    public function displaycreatePassword()
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
