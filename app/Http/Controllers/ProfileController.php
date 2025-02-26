<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function index2()
    {
        $users = User::all();
        return view('user', compact('users'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Mise à jour du nom explicitement
        $user->name = $request->input('name');  // Modification explicite du champ name

        // Mise à jour des autres champs
        $user->fill($request->validated());

        // Si l'email a été modifié, réinitialiser la vérification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Traitement de la photo de profil
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imageName = time() . '.' . $image->extension();
            $imagePath = $image->storeAs('uploads', $imageName, 'public');
            $user->profile_photo = $imagePath;
        }

        // Mise à jour de la bio
        if ($request->has('bio')) {
            $user->bio = $request->bio;
        }

        // Sauvegarde des modifications
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function user()
    {
        return view('user');
    }

    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }
}
