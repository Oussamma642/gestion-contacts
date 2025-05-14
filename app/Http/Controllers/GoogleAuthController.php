<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();

            if (! $user) {
                // Check if a user with the same email already exists
                $user = User::where('email', $google_user->getEmail())->first();

                if ($user) {
                    // Update the existing user's google_id
                    $user->update([
                        'google_id' => $google_user->getId(),
                    ]);
                } else {
                    // Create a new user if no user with the same email exists
                    $user = User::create([
                        'name'      => $google_user->getName(),
                        'email'     => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                    ]);
                }
            }

            Auth::login($user);
            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            dd('Something went wrong: ' . $e->getMessage());
        }
    }
}