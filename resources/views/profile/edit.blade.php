@php
    $role = auth()->user()->role->slug ?? 'student';
    $layout = 'layouts.' . $role;
    // Fallback if layout doesn't exist (though we checked)
    if (!view()->exists($layout)) {
        $layout = 'layouts.main';
    }
@endphp

@extends($layout)

@section('title', 'Profile Settings - EduPlatform')

@section('content')
    <div class="mb-12">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Account Settings</h1>
        <p class="text-slate-500 font-medium">Manage your profile information and security preferences.</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-12">
        <!-- Sidebar/Navigation for Profile -->
        <div class="xl:col-span-1">
            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden sticky top-24">
                <div class="p-8 bg-slate-50 border-b border-slate-100 flex flex-col items-center text-center" x-data="{ photoPreview: null }">
                    <div class="relative mb-4">
                        <img x-show="!photoPreview" src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=6366f1&color=fff&size=128' }}" 
                             class="w-24 h-24 rounded-3xl shadow-xl border-4 border-white object-cover">
                        <img x-show="photoPreview" :src="photoPreview" class="w-24 h-24 rounded-3xl shadow-xl border-4 border-white object-cover" style="display: none;">
                        
                        <button type="button" @click="$refs.photoInput.click()" class="absolute -bottom-2 -right-2 bg-white p-2 rounded-xl shadow-lg border border-slate-100 text-indigo-600 hover:text-indigo-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </button>
                        
                        <form id="profile-photo-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="hidden">
                            @csrf
                            @method('patch')
                            <input type="file" x-ref="photoInput" name="profile_photo" @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => { photoPreview = e.target.result; };
                                    reader.readAsDataURL(file);
                                    $nextTick(() => { $el.closest('form').submit(); });
                                }
                            ">
                        </form>
                    </div>
                    <h3 class="text-xl font-black text-slate-900">{{ auth()->user()->name }}</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">{{ ucfirst($role) }}</p>
                </div>
                <div class="p-4">
                    <nav class="space-y-1">
                        <a href="#profile-info" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-50 text-indigo-600 font-bold text-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Personal Information
                        </a>
                        <a href="#password-update" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-bold text-sm transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Password & Security
                        </a>
                        <a href="#delete-account" class="flex items-center gap-3 px-4 py-3 rounded-xl text-rose-500 hover:bg-rose-50 font-bold text-sm transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Delete Account
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="xl:col-span-2 space-y-12">
            <div id="profile-info" class="bg-white p-8 md:p-12 rounded-3xl border border-slate-200 shadow-sm scroll-mt-24">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div id="password-update" class="bg-white p-8 md:p-12 rounded-3xl border border-slate-200 shadow-sm scroll-mt-24">
                @include('profile.partials.update-password-form')
            </div>

            <div id="delete-account" class="bg-rose-50 p-8 md:p-12 rounded-3xl border border-rose-100 scroll-mt-24">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
