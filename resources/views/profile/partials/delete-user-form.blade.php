<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Smazat účet') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Jakmile bude váš účet smazán, všechna jeho data a zdroje budou trvale odstraněny. Před smazáním si prosím stáhněte všechna data, která si přejete uchovat.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Smazat účet') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Opravdu chcete smazat svůj účet?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Jakmile bude váš účet smazán, všechna jeho data a zdroje budou trvale odstraněny. Zadejte prosím své heslo, abyste potvrdili trvalé smazání účtu.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Heslo') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Heslo') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Zrušit') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Smazat účet') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
