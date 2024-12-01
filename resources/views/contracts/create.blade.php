<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-center">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                Adicionar Contrato - {{$property->name}}
            </h1>                        
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="flex flex-col gap-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg" method="POST" action="{{ route('contracts.store', ['property' => $property->id]) }}">
                @csrf
                <!-- Data de Inicio -->
                <div>
                    <x-input-label for="start_date" :value="__('Data de Inicio')" />
                    <x-text-input id="start_date" class="form-input block mt-1 w-full" type="date" name="start_date" required autofocus />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>
                <!-- Data de Termino -->
                <div>
                    <x-input-label for="end_date" :value="__('Data de Termino')" />
                    <x-text-input id="end_date" class="form-input block mt-1 w-full" type="date" name="end_date" required autofocus />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
                <!-- Valor do Aluguel -->
                <div>
                    <x-input-label for="price_contract" :value="__('Valor do Aluguel')" />
                    <x-text-input id="price_contract" class="form-input block mt-1 w-full price-mask" type="tel" name="price_contract" inputmode="decimal" placeholder="R$ 0,00" required autofocus />
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
                    {{ __('Adicionar Contrato') }}
                </x-primary-button>
            </form>         
        </div>
    </div>
</x-app-layout>
