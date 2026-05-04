<section>
    <header class="mb-8">
        <h2 class="text-2xl font-black text-slate-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-sm font-medium text-slate-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div class="space-y-6">
            <div class="max-w-md space-y-2">
                <label for="update_password_current_password" class="text-sm font-bold text-slate-700 ml-1">{{ __('Current Password') }}</label>
                <input id="update_password_current_password" name="current_password" type="password" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       autocomplete="current-password" />
                @if($errors->updatePassword->get('current_password'))
                    <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->updatePassword->get('current_password')[0] }}</p>
                @endif
            </div>

            <div class="max-w-md space-y-2">
                <label for="update_password_password" class="text-sm font-bold text-slate-700 ml-1">{{ __('New Password') }}</label>
                <input id="update_password_password" name="password" type="password" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       autocomplete="new-password" />
                @if($errors->updatePassword->get('password'))
                    <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->updatePassword->get('password')[0] }}</p>
                @endif
            </div>

            <div class="max-w-md space-y-2">
                <label for="update_password_password_confirmation" class="text-sm font-bold text-slate-700 ml-1">{{ __('Confirm Password') }}</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       autocomplete="new-password" />
                @if($errors->updatePassword->get('password_confirmation'))
                    <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->updatePassword->get('password_confirmation')[0] }}</p>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-6 pt-4 border-t border-slate-50">
            <button type="submit" class="bg-indigo-600 text-white px-10 py-3.5 rounded-2xl font-bold text-sm hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-200 transition-all active:scale-95">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-black text-emerald-600 uppercase tracking-widest flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                    {{ __('Password Changed') }}
                </p>
            @endif
        </div>
    </form>
</section>
