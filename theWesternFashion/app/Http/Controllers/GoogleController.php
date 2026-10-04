<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // 1. Send the user to Google's sign-in screen
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Google sends the user back here after they approve
    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Google sign-in failed. Please try again.']);
        }

        $email = $googleUser->getEmail();

        // Only trust emails that Google itself has verified
        $emailVerified = filter_var($googleUser->user['email_verified'] ?? false, FILTER_VALIDATE_BOOLEAN);

        if (!$email || !$emailVerified) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Your Google email address is not verified.']);
        }

        // Find by Google ID first, then by email (if they signed up the normal way)
        $user = User::where('google_id', $googleUser->getId())->first()
            ?? User::where('email', $email)->first();

        // This email is already linked to a DIFFERENT Google account: refuse
        if ($user && $user->google_id && $user->google_id !== $googleUser->getId()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'This email is linked to another Google account.']);
        }

        // First time here? Create the account.
        if (!$user) {
            $user = new User();
            $user->name  = $googleUser->getName() ?: $email;
            $user->email = $email;
            $user->role  = 'CUSTOMER'; // new accounts are never admins
        }

        // SECURITY: if this email was registered with a password but never
        // verified, someone else may have created it. Remove that password
        // before we trust the account, and clear any pending code.
        if ($user->email_verified_at === null) {
            $user->password                     = null;
            $user->email_verified_at            = now();
            $user->verification_code            = null;
            $user->verification_code_expires_at = null;
            $user->verification_attempts        = 0;
        }

        $user->google_id = $googleUser->getId();
        $user->save();

        Auth::login($user, true);
        $request->session()->forget('verify_user_id');
        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->intended(route('products.index'));
        }

        return redirect()->intended('/');
    }
}