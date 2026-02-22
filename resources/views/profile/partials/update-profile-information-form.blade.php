<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Visualize suas informações pessoais e endereço cadastrado.") }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div>
            <x-input-label :value="__('Foto de Perfil')" />
            <div class="mt-2">
                <img class="h-24 w-24 object-cover rounded-full border-2 border-indigo-500" 
                     src="{{ $user->foto ? asset($user->foto) : asset('assets/imagens/default-avatar.png') }}" 
                     alt="{{ $user->name }}">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label :value="__('Nome Completo')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                    {{ $user->name }}
                </p>
            </div>

            <div>
                <x-input-label :value="__('CPF')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                    {{ $user->cpf ?? 'Não informado' }}
                </p>
            </div>

            <div>
                <x-input-label :value="__('Telefone')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                    {{ $user->telefone ?? 'Não informado' }}
                </p>
            </div>

            <div>
                <x-input-label :value="__('Saldo')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm" style="color: {{ $user->saldo >= 0 ? '#2ecc71' : '#e74c3c' }};">
                    R$ {{ number_format($user->saldo, 2, ',', '.') }}
                </p>
            </div>
        </div>

        <div>
            <x-input-label :value="__('Email')" />
            <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                {{ $user->email }}
            </p>
        </div>

        <hr class="border-gray-700">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <x-input-label :value="__('CEP')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                    {{ $user->cep ?? '---' }}
                </p>
            </div>

            <div class="md:col-span-2">
                <x-input-label :value="__('Rua/Logradouro')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                    {{ $user->rua ?? '---' }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <x-input-label :value="__('Bairro')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                    {{ $user->bairro ?? '---' }}
                </p>
            </div>

            <div class="md:col-span-2">
                <x-input-label :value="__('Cidade/UF')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                    {{ $user->cidade ?? '---' }} / {{ $user->estado ?? '--' }}
                </p>
            </div>

            <div>
                <x-input-label :value="__('Número')" />
                <p class="mt-1 text-gray-800 dark:text-gray-200 p-2 bg-gray-100 dark:bg-gray-700 rounded shadow-sm">
                    {{ $user->numero ?? 'S/N' }}
                </p>
            </div>
        </div>
    </div>
</section>