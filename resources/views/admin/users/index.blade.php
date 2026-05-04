@extends('layouts.admin')

@section('title', 'Manage Users - EduPlatform Admin')

@section('content')
    <div x-data="{ 
        editModal: false, 
        addModal: false,
        currentUser: { id: null, name: '', email: '', role_id: '', status: '' },
        openEdit(user) {
            this.currentUser = { ...user };
            this.editModal = true;
        }
    }">
        <div class="mb-12 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">User Management</h1>
                <p class="text-slate-500 font-medium">Control platform access and manage user permissions.</p>
            </div>
            <div class="flex gap-4">
                <div class="relative">
                    <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all w-64">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <button @click="addModal = true" class="flex items-center gap-2 px-6 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Add User
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm shadow-emerald-100/50">
                <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-100 text-rose-700 px-6 py-4 rounded-2xl mb-8 shadow-sm shadow-rose-100/50">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li class="text-sm font-bold">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                        <tr>
                            <th class="px-8 py-5">Profile</th>
                            <th class="px-8 py-5 text-center">Status</th>
                            <th class="px-8 py-5 text-center">Role</th>
                            <th class="px-8 py-5">Activity</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($users as $user)
                            <tr class="hover:bg-slate-50/80 transition-all duration-300 group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=f1f5f9&color=6366f1' }}" 
                                                 class="w-12 h-12 rounded-2xl object-cover shadow-sm ring-2 ring-white group-hover:ring-indigo-50 transition-all">
                                            <div class="absolute -bottom-1 -right-1 w-4 h-4 {{ $user->status === 'active' ? 'bg-emerald-500' : ($user->status === 'inactive' ? 'bg-slate-300' : 'bg-rose-500') }} border-2 border-white rounded-full"></div>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900">{{ $user->name }}</p>
                                            <p class="text-xs text-slate-400 font-medium">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg {{ $user->status === 'active' ? 'bg-emerald-50 text-emerald-600' : ($user->status === 'inactive' ? 'bg-slate-100 text-slate-600' : 'bg-rose-50 text-rose-600') }} text-[10px] font-black uppercase tracking-widest">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest 
                                        {{ ($user->role->slug ?? '') === 'admin' ? 'bg-rose-50 text-rose-600 border border-rose-100' : 
                                           (($user->role->slug ?? '') === 'instructor' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 
                                           'bg-slate-50 text-slate-600 border border-slate-100') }}">
                                        {{ $user->role->name ?? 'No Role' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs font-bold text-slate-500">Joined</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">{{ $user->created_at->format('M d, Y') }}</p>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button @click="openEdit({{ json_encode($user) }})" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </button>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Archive this user? All associated data will be preserved but access will be revoked.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-300 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-8 bg-slate-50/50 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        </div>

        <!-- Add User Modal -->
        <div x-show="addModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="display: none;">
            <div @click.away="addModal = false" 
                 class="bg-white rounded-[32px] w-full max-w-lg overflow-hidden shadow-2xl"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-95 opacity-0"
                 x-transition:enter-end="scale-100 opacity-100">
                <div class="p-8 border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-black text-slate-900">Create New User</h3>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Add a new account to the platform</p>
                    </div>
                    <button @click="addModal = false" class="text-slate-300 hover:text-slate-900 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Full Name</label>
                        <input type="text" name="name" required placeholder="John Doe"
                               class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                        <input type="email" name="email" required placeholder="john@example.com"
                               class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Access Level</label>
                            <select name="role_id" required
                                    class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900 appearance-none">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Initial Status</label>
                            <select name="status" required
                                    class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900 appearance-none">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" @click="addModal = false" class="flex-1 px-6 py-4 border-2 border-slate-100 rounded-2xl font-black text-sm text-slate-400 hover:bg-slate-50 transition-all uppercase tracking-widest">Cancel</button>
                        <button type="submit" class="flex-1 px-6 py-4 bg-slate-900 text-white rounded-2xl font-black text-sm hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 uppercase tracking-widest">Create User</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div x-show="editModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="display: none;">
            <div @click.away="editModal = false" 
                 class="bg-white rounded-[32px] w-full max-w-lg overflow-hidden shadow-2xl"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-95 opacity-0"
                 x-transition:enter-end="scale-100 opacity-100">
                <div class="p-8 border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-black text-slate-900">Edit Permissions</h3>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Update user account & role</p>
                    </div>
                    <button @click="editModal = false" class="text-slate-300 hover:text-slate-900 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form :action="'{{ url('/admin/users') }}/' + currentUser.id" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Full Name</label>
                        <input type="text" name="name" x-model="currentUser.name" 
                               class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                        <input type="email" name="email" x-model="currentUser.email" 
                               class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Access Level</label>
                            <select name="role_id" x-model="currentUser.role_id" 
                                    class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900 appearance-none">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Status</label>
                            <select name="status" x-model="currentUser.status" 
                                    class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 outline-none transition-all font-bold text-slate-900 appearance-none">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" @click="editModal = false" class="flex-1 px-6 py-4 border-2 border-slate-100 rounded-2xl font-black text-sm text-slate-400 hover:bg-slate-50 transition-all uppercase tracking-widest">Cancel</button>
                        <button type="submit" class="flex-1 px-6 py-4 bg-slate-900 text-white rounded-2xl font-black text-sm hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 uppercase tracking-widest">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
