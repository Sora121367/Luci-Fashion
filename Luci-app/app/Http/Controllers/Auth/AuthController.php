<?php

namespace App\Http\Controllers\Auth;

use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'Firstname' => 'required',
                'Lastname' => 'required',
                'phonenumber' => 'required',
                'city' => 'nullable|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'gender' => 'nullable|string',
            ]);

            $verification_code = rand(100000, 999999); // Generate a 6-digit code

            $user = User::create([
                'Firstname' => $validated['Firstname'],
                'Lastname' => $validated['Lastname'],
                'phonenumber' => $validated['phonenumber'] ?? null,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'city' => $validated['city'] ?? null,
                'role' => 'user',
                'gender' => $validated['gender'] ?? null,
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
        $credentials = $request->only('email', 'password');

        if (Auth::check()) {
            return redirect('home');
        }
        // Check if it's an admin login
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        // Check if it's a user login
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Logs the user out

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Prevent CSRF attacks

        return redirect('/login')->with('success', 'You have been logged out.');
    }



    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogle()
    {
        try {
            // Retrieve the Google user information
            $googleUser = Socialite::driver('google')->user();

            $findUser = User::where('google_id', $googleUser->id)->first();


            if ($findUser) {
                // If the user exists, log them in
                Auth::login($findUser);
                return redirect()->intended('/');
            } else {

                $googleUserData = [
                    'google_id' => $googleUser->id,
                    'email' => $googleUser->email,
                    'Firstname' => $googleUser->user['given_name'] ?? '',
                    'Lastname' => $googleUser->user['family_name'] ?? '',
                    'role' => 'user',
                    'city' => 'Unknown',
                    'gender' => 'Unknown',
                    'phonenumber' => 'Unknown',
                    'password' => bcrypt('default_password'),
                ];

                // Create or update the user
                $user = User::create($googleUserData);

                // Log the user in
                Auth::login($user);

                return redirect('/'); // Redirect the user after login
            }
        } catch (Exception $e) {
            // Return JSON response in case of failure
            return response()->json([
                'error' => 'Google login failed. Please try again.',
                'exception' => $e->getMessage()
            ], 400);
        }
    }




    public function verifyCode(Request $request)
    {
        // Validate the combined code
        $request->validate([
            'code_combined' => 'required|numeric|digits:6',
        ]);

        $code = $request->input('code_combined');

        // Find the user by the verification code
        $user = User::where('verification_code', $code)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['code_combined' => 'Invalid verification code. Please try again.']);
        }

        // Check if already verified
        if ($user->email_verified_at) {
            Auth::login($user); // Log them in
            return redirect('/')->with('success', 'Your email is already verified. You are now logged in.');
        }

        // Mark as verified
        $user->email_verified_at = now();
        $user->save();

        // Log the user in
        Auth::login($user);

        return redirect('/')->with('success', 'Email verified successfully! You are now logged in.');
    }





    // public function verifycode()
    // {
    //     return redirect('/')->with('success', 'register successful!');
    // }





    public function verifyResetCode(Request $request)
    {
        $request->validate([
             'code_combined' => 'required|numeric|digits:6',
        ]);
       
        $code = $request->input('code_combined');


        $user = User::where('reset_code', $code)->first();

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
        if( Auth::check() && Auth::user()->email_verified_at ) {
             return redirect('/')->with('success', 'You’re already verified and logged in.');
        }
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
        if( Auth::check() && Auth::user()->reset_code ==!null ) {
            return redirect('/')->with('success','You’re already verified and logged in.');
        }
        return view('Auth.createpassword');
    }

    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::guard('web')->check()) {
            return redirect('/');
        }


        return view('auth.login');
    }



public function displayForgetPW()
{ 
    if (Auth::check()) {
        return redirect('/')->with('info', 'You’re already verified and logged in.');
    }
    return view('Auth.forgetpw');
}

}
