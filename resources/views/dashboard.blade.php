<x-app-layout>
    {{-- <x-slot name="header">
        <div class="flex justify-between align-center">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h1>
            <a class="inline-flex items-center mt-auto px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 justify-center" href="{{ route('properties.create') }}" title="Novo Imóvel">
                Novo Imóvel
            </a>
        </div>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 ">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">Imóveis Alugados</h2>
                    <h3 class="font-semibold text-4xl text-gray-800 dark:text-gray-200">{{$proprietiesCountWithContract}}</h3>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">Imóveis Vagos</h2>
                    <h3 class="font-semibold text-4xl text-gray-800 dark:text-gray-200">{{$proprietiesCountWithoutContract}}</h3>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-5">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">Alugueis Próximos do Vencimento</h2>
                <div class="grid grid-cols-4 gap-4 ">
                    @if($proprietiesContractEndSoon->isEmpty())
                        <p>Você Não Possui Propriedades Com Alugueis Ativos.</p>
                    @else
                        @foreach ($proprietiesContractEndSoon as $item)                
                            <article title="{{ $item->name }}" class="relative flex flex-col bg-white dark:bg-gray-900 sm:rounded-lg">
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
            </div>
        </div>
        

    </div>
</x-app-layout>
