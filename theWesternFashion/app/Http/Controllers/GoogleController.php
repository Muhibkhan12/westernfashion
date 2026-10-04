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
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Google sign-in failed. Please try again.']);
        }

        // Only trust emails that Google itself has verified
        if (!($googleUser->user['email_verified'] ?? false)) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Your Google email address is not verified.']);
        }

        // Find the user by Google ID, or by email if they signed up the normal way
        $user = User::where('google_id', $googleUser->getId())
                    ->orWhere('email', $googleUser->getEmail())
                    ->first();

        // First time here? Create the account.
        if (!$user) {
            $user = new User();
            $user->name  = $googleUser->getName() ?? $googleUser->getEmail();
            $user->email = $googleUser->getEmail();
            $user->role  = 'customer'; // new accounts are never admins
        }

        // SECURITY: if this email was registered with a password but never
        // verified, someone else may have created it. Remove that password
        // before we trust the account.
        if ($user->email_verified_at === null) {
            $user->password          = null;
            $user->email_verified_at = now();
        }

        $user->google_id = $googleUser->getId();
        $user->save();

        Auth::login($user, true);
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->intended(route('products.index'));
        }

        return redirect()->intended('/');
    }
}