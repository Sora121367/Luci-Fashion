<?php

namespace App\Http\Controllers\Auth;

use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',

                'is_verified' => 'nullable|boolean',
            ]);

            $verification_code = rand(100000, 999999); // Generate a 6-digit code

            $user = User::create([
                'Firstname' => $validated['Firstname'],
                'Lastname' => $validated['Lastname'],
                'phonenumber' => $validated['phonenumber'] ?? null,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'user',
                'verification_code' => $verification_code,
                'is_verified' => $validated['is_verified'] ?? false,
            ]); 

            

            // Send verification code via email
          //  Mail::to($user->email)->send(new VerifyEmail($verification_code));

            // Dispatch verification email via queued job
            SendMailJob::dispatch($user, $verification_code,"verify");
            Log::info('Verification email job dispatched');

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

    // First check if admin exists by email in admins table
     $admin = Admin::where('email', $request->email)->first();

    if ($admin) {
        if (!$admin->is_verified) {
            return back()->withErrors(['email' => 'Please verify your admin account first.']);
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials.']);
    }

    // Else check regular users
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    if (!$user->is_verified) {
        return back()->withErrors(['email' => 'Please verify your email first.']);
    }

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
        $googleUser = Socialite::driver('google')->user(); 

        // First, try to find user by google_id
        $user = User::where('google_id', $googleUser->id)->first();

        if (!$user) {
            // If no user with google_id, try finding by email
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Link Google account to existing email/password user
                $user->update([
                    'google_id' => $googleUser->id,
                ]);
            } else {
                // No user found, create a new one
                $user = User::create([
                    'google_id' => $googleUser->id,
                    'email' => $googleUser->email,
                    'Firstname' => $googleUser->user['given_name'] ?? '',
                    'Lastname' => $googleUser->user['family_name'] ?? '',
                    'role' => 'user',
                    'city' => 'Unknown',
                    'gender' => 'Unknown',
                    'phonenumber' => 'Unknown',
                    'password' => bcrypt(Str::random(16)), // don't use default string password
                ]);
            }
        }

        // Log the user in
        Auth::login($user);

        return redirect()->intended('/');
    } catch (Exception $e) {
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
        $user->is_verified = true;  
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
       

        // Use Job for forget password
       SendMailJob::dispatch($user, $reset_code,"reset");
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
        if( Auth::check() && Auth::user()->reset_code == null ) {
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


        return view('Auth.login');
    }



public function displayForgetPW()
{ 
    if (Auth::check()) {
        return redirect('/')->with('info', 'You’re already verified and logged in.');
    }
    return view('Auth.forgetpw');
}

}
