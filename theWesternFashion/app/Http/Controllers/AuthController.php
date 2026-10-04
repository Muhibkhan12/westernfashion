<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // =========================================================
    // LOGIN
    // =========================================================

    // Show the login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Check the email + password
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Same message for "no such user" and "wrong password" (so nobody can
        // find out which emails exist). Google-only users have no password.
        if (!$user || !$user->password || !Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['email' => 'The email or password is incorrect.'])
                ->onlyInput('email');
        }

        // Email not verified yet? Send a fresh code and go to the verify page.
        if (!$user->email_verified_at) {
            $this->sendVerificationCode($user);
            session(['verify_user_id' => $user->id]);

            return redirect()->route('verify.show')
                ->with('status', 'Please verify your email first. We sent you a new code.');
        }

        return $this->loginUser($request, $user, $request->boolean('remember'));
    }

    // =========================================================
    // REGISTER
    // =========================================================

    // Show the registration page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Create the account, then email a 6-digit code
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255|unique:users,email',
            'password'   => ['required', 'confirmed', Password::min(8)],
            'terms'      => 'accepted',
        ], [
            'terms.accepted' => 'Please accept the Terms of Service and Privacy Policy.',
        ]);

        $user = new User([
            'name'     => trim($request->first_name . ' ' . $request->last_name),
            'email'    => $request->email,
            'password' => $request->password, // hashed automatically by the User model
        ]);

        // SECURITY: new sign-ups are NOT admins. Change 'customer' if your
        // role column uses a different word. Make admins yourself (see notes).
        $user->role = 'customer';
        $user->save();

        $this->sendVerificationCode($user);

        // Remember who is verifying (they are NOT logged in yet)
        session(['verify_user_id' => $user->id]);

        return redirect()->route('verify.show')
            ->with('status', 'Account created! We emailed you a 6-digit code.');
    }

    // =========================================================
    // EMAIL VERIFICATION (6-digit code)
    // =========================================================

    // Show the "enter your code" page
    public function showVerify()
    {
        $user = $this->pendingUser();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('auth.verify', ['email' => $this->maskEmail($user->email)]);
    }

    // Check the code the user typed
    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $user = $this->pendingUser();

        if (!$user) {
            return redirect()->route('login');
        }

        // No code saved, or it is older than 10 minutes
        if (!$user->verification_code || now()->greaterThan($user->verification_code_expires_at)) {
            return back()->withErrors(['code' => 'This code has expired. Please request a new one.']);
        }

        // Too many wrong guesses: this code is dead, ask for a new one
        if ($user->verification_attempts >= 5) {
            return back()->withErrors(['code' => 'Too many wrong attempts. Please request a new code.']);
        }

        // Wrong code
        if (!Hash::check($request->code, $user->verification_code)) {
            $user->increment('verification_attempts');

            return back()->withErrors(['code' => 'That code is not correct.']);
        }

        // Correct! Mark the email as verified and clean up
        $user->email_verified_at            = now();
        $user->verification_code            = null;
        $user->verification_code_expires_at = null;
        $user->verification_attempts        = 0;
        $user->save();

        return $this->loginUser($request, $user);
    }

    // Send a new code
    public function resend()
    {
        $user = $this->pendingUser();

        if (!$user) {
            return redirect()->route('login');
        }

        $this->sendVerificationCode($user);

        return back()->with('status', 'A new code has been sent to your email.');
    }

    // =========================================================
    // LOGOUT
    // =========================================================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // =========================================================
    // Helper functions
    // =========================================================

    // Log the user in and send them to the right place
    private function loginUser(Request $request, User $user, bool $remember = false)
    {
        Auth::login($user, $remember);

        $request->session()->forget('verify_user_id');
        $request->session()->regenerate(); // protects against session fixation

        if ($user->role === 'admin') {
            return redirect()->intended(route('products.index'));
        }

        return redirect()->intended('/');
    }

    // Make a 6-digit code, save it (hashed) and email it
    private function sendVerificationCode(User $user)
    {
        // e.g. "048213" (leading zeros are kept)
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->verification_code            = Hash::make($code);
        $user->verification_code_expires_at = now()->addMinutes(10);
        $user->verification_attempts        = 0;
        $user->save();

        Mail::to($user->email)->send(new VerificationCodeMail($user, $code));
    }

    // The unverified user who is on the verify page (stored in the session)
    private function pendingUser()
    {
        $id   = session('verify_user_id');
        $user = $id ? User::find($id) : null;

        return ($user && !$user->email_verified_at) ? $user : null;
    }

    // "ayesha@gmail.com" -> "ay****@gmail.com"
    private function maskEmail(string $email): string
    {
        [$name, $domain] = explode('@', $email);

        return substr($name, 0, 2) . str_repeat('*', max(strlen($name) - 2, 1)) . '@' . $domain;
    }
}