<section>
    <header class="mb-8">
        <h2 class="text-2xl font-black text-slate-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm font-medium text-slate-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label for="name" class="text-sm font-bold text-slate-700 ml-1">{{ __('Full Name') }}</label>
                <input id="name" name="name" type="text" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @if($errors->get('name'))
                    <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->get('name')[0] }}</p>
                @endif
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-bold text-slate-700 ml-1">{{ __('Email Address') }}</label>
                <input id="email" name="email" type="email" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @if($errors->get('email'))
                    <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->get('email')[0] }}</p>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                        <p class="text-xs font-bold text-amber-700 leading-relaxed">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="block mt-1 text-indigo-600 hover:text-indigo-800 underline decoration-2 underline-offset-4">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-xs font-black text-emerald-600 uppercase tracking-widest">
                                {{ __('Verification link sent!') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2 space-y-2">
                <label for="headline" class="text-sm font-bold text-slate-700 ml-1">{{ __('Professional Headline') }}</label>
                <input id="headline" name="headline" type="text" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       value="{{ old('headline', $user->headline) }}" placeholder="e.g. Senior Software Engineer at Google" />
                @if($errors->get('headline'))
                    <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->get('headline')[0] }}</p>
                @endif
            </div>

            <div class="md:col-span-2 space-y-2">
                <label for="bio" class="text-sm font-bold text-slate-700 ml-1">{{ __('Bio / About Me') }}</label>
                <textarea id="bio" name="bio" rows="4"
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none resize-none" 
                       placeholder="Share your experience and background...">{{ old('bio', $user->bio) }}</textarea>
                @if($errors->get('bio'))
                    <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->get('bio')[0] }}</p>
                @endif
            </div>

            <div class="space-y-2">
                <label for="website" class="text-sm font-bold text-slate-700 ml-1">{{ __('Website URL') }}</label>
                <input id="website" name="website" type="url" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       value="{{ old('website', $user->website) }}" placeholder="https://yourwebsite.com" />
            </div>

            <div class="space-y-2">
                <label for="twitter" class="text-sm font-bold text-slate-700 ml-1">{{ __('Twitter URL') }}</label>
                <input id="twitter" name="twitter" type="url" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       value="{{ old('twitter', $user->twitter) }}" placeholder="https://twitter.com/yourhandle" />
            </div>

            <div class="space-y-2">
                <label for="linkedin" class="text-sm font-bold text-slate-700 ml-1">{{ __('LinkedIn URL') }}</label>
                <input id="linkedin" name="linkedin" type="url" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       value="{{ old('linkedin', $user->linkedin) }}" placeholder="https://linkedin.com/in/yourprofile" />
            </div>

            <div class="space-y-2">
                <label for="youtube" class="text-sm font-bold text-slate-700 ml-1">{{ __('YouTube Channel') }}</label>
                <input id="youtube" name="youtube" type="url" 
                       class="block w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                       value="{{ old('youtube', $user->youtube) }}" placeholder="https://youtube.com/c/yourchannel" />
            </div>
        </div>

        <div class="flex items-center gap-6 pt-4 border-t border-slate-50">
            <button type="submit" class="bg-indigo-600 text-white px-10 py-3.5 rounded-2xl font-bold text-sm hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-200 transition-all active:scale-95">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-black text-emerald-600 uppercase tracking-widest flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                    {{ __('Successfully Saved') }}
                </p>
            @endif
        </div>
    </form>
</section>
