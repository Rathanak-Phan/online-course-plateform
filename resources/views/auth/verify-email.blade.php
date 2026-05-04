<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-slate-50 relative overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-violet-100 rounded-full blur-3xl opacity-50"></div>

        <div class="w-full max-w-md relative z-10">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-indigo-50 text-indigo-600 rounded-3xl mb-8 animate-float">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 mb-2">Verify Your Email</h2>
                <p class="text-slate-500 text-sm leading-relaxed px-4">
                    {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just sent you.') }}
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100">
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 text-sm font-medium rounded-2xl flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ __('A new verification link has been sent to your email address.') }}</span>
                    </div>
                @endif

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full btn-primary-gradient shadow-lg">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-3.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
