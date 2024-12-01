<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-center">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                Imóveis
            </h1>
            <a class="inline-flex items-center mt-auto px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 justify-center" href="{{ route('properties.create') }}" title="Novo Imóvel">
                Novo Imóvel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-4 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($properties->isEmpty())
                <p>Você não possui propriedades cadastradas.</p>
            @else
                @foreach ($properties as $item)                
                    <article title="{{ $item->name }}" class="relative flex flex-col bg-white dark:bg-gray-800 sm:rounded-lg">
                        <a href="{{ route('properties.show', $item->id) }}" class="overflow-hidden shadow-sm  block p-6 text-gray-900 dark:text-gray-100">
                            <h2>{{ $item->name }}</h2>
                            @if($item->contracts->isNotEmpty())
                                <ul class="mt-3">
                                    @foreach($item->contracts as $contract)
                                        <li>
                                            Aluguel: {{ $contract->formatted_price  }}
                                            <small class="block">{{$contract->getContractTimeRemaing()}}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </a>
                        @if($item->contracts->isEmpty())
                            <a class="inline-flex items-center mt-auto px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 justify-center" href="{{ route('contracts.create', $item->id) }}" title="Adicionar Contrato">
                                Adicionar Contrato
                            </a>
                        @endif
                    </article>
                @endforeach
            @endif
        </div>
        <div class="pagination mt-5">
            {{ $properties->links() }}
        </div>
    </div>
</x-app-layout>
