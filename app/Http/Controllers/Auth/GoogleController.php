<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Update google_id and avatar if not set
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'profile_photo' => $googleUser->getAvatar(),
                ]);
            } else {
                // Register new user
                $studentRole = Role::where('slug', User::ROLE_STUDENT)->first();
                
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(16)),
                    'role_id' => $studentRole ? $studentRole->id : null,
                    'profile_photo' => $googleUser->getAvatar(),
                    'status' => 'active',
                ]);
            }

            Auth::login($user);

            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->hasRole(User::ROLE_INSTRUCTOR)) {
                return redirect()->intended('/instructor/dashboard');
            }

            return redirect()->intended('/student/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong with Google sign in.');
        }
    }
}
