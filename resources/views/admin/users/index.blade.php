@extends('layouts.admin')

@section('title', 'Manage Users - EduPlatform Admin')

@section('content')
    <div class="mb-12 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 mb-2">User Management</h1>
            <p class="text-slate-500 font-medium">View and manage all registered users on the platform.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase">
                <tr>
                    <th class="px-8 py-4">User</th>
                    <th class="px-8 py-4">Role</th>
                    <th class="px-8 py-4">Joined</th>
                    <th class="px-8 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f1f5f9&color=64748b" class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $user->role_id == 1 ? 'bg-rose-100 text-rose-600' : ($user->role_id == 2 ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-600') }}">
                                {{ $user->role->name ?? 'Student' }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-sm text-slate-500">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-8 py-6">
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-sm">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 bg-slate-50 border-t border-slate-200">
            {{ $users->links() }}
        </div>
    </div>
@endsection
