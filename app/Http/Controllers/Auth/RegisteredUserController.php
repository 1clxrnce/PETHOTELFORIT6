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
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:Users,username'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cusFName' => ['required', 'string', 'max:50'],
            'cusMName' => ['nullable', 'string', 'max:50'],
            'cusLName' => ['required', 'string', 'max:50'],
            'phoneNum' => ['required', 'string', 'max:20', 'unique:Customers,phoneNum'],
            'email' => ['required', 'email', 'max:100', 'unique:Customers,email'],
            'address' => ['nullable', 'string'],
        ]);

        // Create User account with Customer role
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'Customer',
            'status' => 'Active',
        ]);

        // Create Customer profile
        \App\Models\Customer::create([
            'userID' => $user->userID,
            'cusFName' => $request->cusFName,
            'cusMName' => $request->cusMName,
            'cusLName' => $request->cusLName,
            'phoneNum' => $request->phoneNum,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
