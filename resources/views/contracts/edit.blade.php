<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-center">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                Editar Contrato
            </h1>            
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg" method="POST" action="{{ route('contracts.update',$contract->id) }}">
                @csrf
                @method('PATCH')
                <!-- Data de Inicio -->
                <div>
                    <x-input-label for="start_date" :value="__('Data de Inicio')" />
                    <x-text-input id="start_date" class="form-input block mt-1 w-full" type="date" name="start_date" required autofocus value="{{ old('start_date', $contract->start_date ? $contract->start_date->format('Y-m-d') : '') }}" />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>
                <!-- Data de Termino -->
                <div>
                    <x-input-label for="end_date" :value="__('Data de Termino')" />
                    <x-text-input id="end_date" class="form-input block mt-1 w-full" type="date" name="end_date" required autofocus value="{{ old('end_date', $contract->end_date ? $contract->end_date->format('Y-m-d') : '') }}" />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
                <!-- Valor do Aluguel -->
                <div>
                    <x-input-label for="price_contract" :value="__('Valor do Aluguel')" />
                    <x-text-input id="price_contract" class="form-input block mt-1 w-full price-mask" type="tel" name="price_contract" inputmode="decimal" placeholder="{{ old('price_contract', $contract->formatted_price) }}" required autofocus />
                    <x-input-error :messages="$errors->get('price_contract')" class="mt-2" />
                </div>          
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif                      
                <x-primary-button class="ml-auto mt-4">
                    {{ __('Atualizar Contrato') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>