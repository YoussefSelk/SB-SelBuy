<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Role;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


     public function store(Request $request): RedirectResponse
     {

         $request->validate([
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', Rules\Password::defaults(), 'confirmed'],
             'city' => ['required'],
             'phone' => ['required'],
         ]);

         $user = User::create([
             'name' => $request->input('name'),
             'email' => $request->input('email'),
             'password' => Hash::make($request->input('password')),
             'ville' => $request->input('city'),
             'phone' => $request->input('phone'),
         ]);

         $buyerRole = Role::where('name', 'Buyer')->first();
         $user->roles()->attach($buyerRole);

         event(new Registered($user));

         Auth::login($user);

         // Redirect users based on their role
         if ($user->hasRole('Admin')) {
             return redirect()->route('dashboard');
         } else {
             return redirect('/');
         }
     }

}
