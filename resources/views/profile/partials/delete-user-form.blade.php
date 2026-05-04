<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-black text-rose-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-2 text-sm font-medium text-rose-700/70">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        class="bg-rose-600 text-white px-8 py-3.5 rounded-2xl font-bold text-sm hover:bg-rose-700 transition-all active:scale-95 shadow-lg shadow-rose-100"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Permanently Delete Account') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-slate-900">
                {{ __('Are you absolutely sure?') }}
            </h2>

            <p class="mt-4 text-sm font-medium text-slate-500 leading-relaxed">
                {{ __('This action cannot be undone. Once your account is deleted, all of its resources and data will be permanently wiped from our servers. Please enter your password to confirm.') }}
            </p>

            <div class="mt-8 space-y-2">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 transition-all outline-none"
                    placeholder="{{ __('Verify your password') }}"
                />
                @if($errors->userDeletion->get('password'))
                    <p class="text-xs font-bold text-rose-500 mt-2 ml-1">{{ $errors->userDeletion->get('password')[0] }}</p>
                @endif
            </div>

            <div class="mt-10 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3.5 rounded-xl font-bold text-sm text-slate-500 hover:bg-slate-50 transition-colors">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="px-8 py-3.5 bg-rose-600 text-white rounded-xl font-bold text-sm hover:bg-rose-700 transition-all">
                    {{ __('Confirm Deletion') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
