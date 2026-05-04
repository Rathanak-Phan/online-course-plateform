<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-slate-50 relative overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-violet-100 rounded-full blur-3xl opacity-50"></div>

        <div class="w-full max-w-md relative z-10">
            <div class="text-center mb-10">
                <a href="/" class="inline-flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <span class="text-white text-2xl font-black">E</span>
                    </div>
                    <span class="text-3xl font-bold text-slate-900 tracking-tight">EduPlatform</span>
                </a>
                <h2 class="text-2xl font-extrabold text-slate-900 mb-2">Reset Password</h2>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Set a new password for your account.
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="block w-full px-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">New Password</label>
                        <input id="password" type="password" name="password" required class="block w-full px-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Confirm New Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required class="block w-full px-4 py-3.5 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full btn-primary-gradient shadow-lg">
                        {{ __('Reset Password') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
