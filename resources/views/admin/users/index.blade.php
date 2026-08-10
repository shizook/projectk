@extends('layouts.app')
@section('title','Kelola User')

@section('content')
<div class="space-y-6">

    <!-- Container 1: Header Judul Halaman -->
    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur">
        <h1 class="mt-1 text-2xl font-bold text-white">Kelola Pengguna</h1>
        <p class="mt-1 text-sm text-slate-400">Atur hak akses dan kelola daftar pengguna yang terdaftar di sistem.</p>
    </div>

    <!-- Alert Notifikasi Status -->
    @if(session('ok'))
        <div class="rounded-2xl border border-emerald-500/30 bg-emerald-500/10 px-5 py-3 text-sm text-emerald-300">
            {{ session('ok') }}
        </div>
    @endif

    @error('user')
        <div class="rounded-2xl border border-rose-500/30 bg-rose-500/10 px-5 py-3 text-sm text-rose-300">
            {{ $message }}
        </div>
    @enderror

    <!-- Container 2: Tabel Daftar User -->
    <div class="overflow-x-auto rounded-3xl border border-white/10 bg-white/5 p-6">
        <table class="w-full text-left text-sm text-slate-300">
            <thead>
                <tr class="border-b border-white/10 text-xs font-semibold uppercase tracking-widest text-slate-400">
                    <th class="pb-4">Nama</th>
                    <th class="pb-4">Email</th>
                    <th class="pb-4">Role</th>
                    <th class="pb-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($users as $u)
                <tr class="transition hover:bg-white/5">
                    <td class="py-4 font-semibold text-white">{{ $u->name }}</td>
                    <td class="py-4 text-slate-400">{{ $u->email }}</td>
                    <td class="py-4">
                        <form method="POST" action="{{ route('admin.users.updateRole',$u) }}">
                            @csrf 
                            @method('PATCH')
                            <!-- Select Role Rapi -->
                            <select name="role" onchange="this.form.submit()" class="rounded-2xl border border-white/10 bg-[#03081a] px-3 py-1.5 text-xs text-white focus:border-white/30 focus:outline-none cursor-pointer">
                                <option value="user" @selected($u->role==='user')>User</option>
                                <option value="author" @selected($u->role==='author')>Author</option>
                                <option value="admin" @selected($u->role==='admin')>Admin</option>
                            </select>
                        </form>
                    </td>
                    <td class="py-4">
                        @php
                            $isSelf = auth()->id() === $u->id;
                            $isLastAdmin = $u->role === 'admin' && $adminCount <= 1;
                        @endphp

                        @if(!$isSelf && !$isLastAdmin)
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="inline" onsubmit="return confirm('Hapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-semibold text-red-500 underline hover:text-red-400">
                                    Hapus
                                </button>
                            </form>
                        @else
                            <span class="text-xs italic text-slate-500">
                                {{ $isSelf ? 'Akun Anda' : 'Admin Utama' }}
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Navigasi Halaman (Pagination) -->
        @if($users->hasPages())
            <div class="mt-6 border-t border-white/10 pt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>
@endsection