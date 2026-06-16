<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.profile');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('avatar')) {

        $avatar = $request->file('avatar')
            ->store('avatars', 'public');

        $user->avatar = $avatar;
    }

    $user->name = $request->name;
    $user->email = $request->email;

    $user->save();

    return redirect()
        ->route('profile')
        ->with('success', 'Profil berhasil diperbarui');
}


    public function password()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();

        $user->password = Hash::make(
            $request->password
        );

        $user->save();

        return redirect()
            ->route('profile')
            ->with('success','Password berhasil diubah');
    }
}