<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(20);
        $adminCount = User::where('role', 'admin')->count();

        return view('admin.users.index', compact('users', 'adminCount'));
    }

    public function updateRole(User $user, Request $request)
    {
        $request->validate(['role' => 'required|in:user,author,admin']);
        $user->update(['role'=>$request->role]);
        return back()->with('ok','Role user diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors([
                'user' => 'Anda tidak dapat menghapus akun yang sedang digunakan.',
            ]);
        }

        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return back()->withErrors([
                'user' => 'Tidak dapat menghapus admin terakhir.',
            ]);
        }

        $user->delete();

        return back()->with('ok', 'User berhasil dihapus.');
    }
}
