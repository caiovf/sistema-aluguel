<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-center">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                Editar Imóvel
            </h1>            
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg" method="POST" action="{{ route('properties.update',$property->id) }}">
                @csrf
                @method('PATCH')
                <!-- Nome -->
                <div>
                    <x-input-label for="name" :value="__('Nome do Imóvel')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus placeholder="{{$property->name}}" />
                </div>
                <x-primary-button class="ml-auto mt-4">
                    {{ __('Atualizar Imóvel') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>