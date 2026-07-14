@extends('layouts.app')
@section('title','Kelola User')

@section('content')
<h1 class="text-2xl font-bold mb-4">Users</h1>

@if(session('ok'))
    <div class="mb-4 rounded-xl border border-emerald-400/60 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
        {{ session('ok') }}
    </div>
@endif

@error('user')
    <div class="mb-4 rounded-xl border border-rose-400/60 bg-rose-500/10 px-4 py-3 text-sm text-rose-300">
        {{ $message }}
    </div>
@enderror

<table class="w-full text-left border">
  <thead><tr><th class="p-2">Nama</th><th class="p-2">Email</th><th class="p-2">Role</th><th class="p-2">Aksi</th></tr></thead>
  <tbody>
    @foreach($users as $u)
    <tr>
      <td class="p-2">{{ $u->name }}</td>
      <td class="p-2">{{ $u->email }}</td>
      <td class="p-2">{{ $u->role }}</td>
      <td class="p-2">
        <div class="flex flex-wrap items-center gap-2">
          <form method="POST" action="{{ route('admin.users.updateRole',$u) }}">
            @csrf @method('PATCH')
            <select name="role" onchange="this.form.submit()" class="rounded border border-slate-600 bg-slate-800 px-2 py-1 text-sm text-slate-100">
              <option value="user" @selected($u->role==='user')>User</option>
              <option value="author" @selected($u->role==='author')>Author</option>
              <option value="admin" @selected($u->role==='admin')>Admin</option>
            </select>
          </form>
          @php
              $isSelf = auth()->id() === $u->id;
              $isLastAdmin = $u->role === 'admin' && $adminCount <= 1;
          @endphp
          @if(!$isSelf && !$isLastAdmin)
            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Hapus pengguna ini?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="rounded border border-rose-400 px-3 py-1 text-xs font-semibold text-rose-300 transition hover:bg-rose-500 hover:text-white">
                Hapus
              </button>
            </form>
          @endif
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-4">
  {{ $users->links() }}
</div>
@endsection

     
