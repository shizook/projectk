<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email,' . $user->id],
            'profile_photo' => ['nullable','image','max:2048'],
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('avatars', 'public');

            if ($user->profile_photo_path && \Storage::disk('public')->exists($user->profile_photo_path)) {
                \Storage::disk('public')->delete($user->profile_photo_path);
            }

            $data['profile_photo_path'] = $path;
        }

        $user->update($data);

        return back()->with('ok', 'Profil berhasil diperbarui.');
    }
}