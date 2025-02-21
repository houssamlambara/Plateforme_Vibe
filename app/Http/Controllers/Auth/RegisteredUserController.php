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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'pseudo' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:255'],
            'profile_photo' => ['image', 'mimes:jpg,png,gif','required', 'max:25500'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        if($request->hasFile('profile_photo')){
            $image = $request->file('profile_photo');
            $imageName = time() . "." . $image->extension();
            $imagePath = $image->storeAs('uploads', $imageName, 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'pseudo' => $request->pseudo,
            'profile_photo' => $imagePath,
            'bio' => $request->bio ?? '', 
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
