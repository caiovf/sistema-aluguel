<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-center">
            <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                {{$property->name}}
            </h1>            
            <div class="d-flex gap-2">
                <a class="inline-flex items-center mt-auto px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 justify-center" href="{{ route('properties.edit', $property->id) }}" title="Editar Imóvel">
                    Editar Imóvel
                </a>
                @if ($propertyActiveContract->isEmpty())
                    <a class="inline-flex items-center mt-auto px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 justify-center" href="{{ route('contracts.create', $property->id) }}" title="Adicionar Contrato">
                        Novo Contrato
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-5">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">Contrato Atual</h2>
                @if ($propertyActiveContract->isEmpty())
                    <p class="text-gray-900 dark:text-gray-100">A Propriedade não possui Contrato Ativo</p>
                @else
                    <table class="table-fixed w-full border-collapse border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-800 border-rounded">
                        <thead>
                        <tr>
                            <th class="border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Data de Inicio</th>
                            <th class="border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Data de Termino</th>
                            <th class="border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Período do Contrato</th>
                            <th class="border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Valor do Aluguel</th>
                            <th class="border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Status</th>
                            <th class="border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{$propertyActiveContract[0]->getFormattedDate($propertyActiveContract[0]->start_date)}}</td>
                            <td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{$propertyActiveContract[0]->getFormattedDate($propertyActiveContract[0]->end_date)}}</td>
                            <td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{$propertyActiveContract[0]->getContractTimeRemaing($propertyActiveContract[0]->start_date)}}</td>
                            <td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{$propertyActiveContract[0]->formatted_price}}</td>
                            <td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{($propertyActiveContract[0]->active_contract) ? 'Ativo' : ''}}</td>
                            <td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                <div class="flex gap-2">
                                    <a title="Editar Contrato" href="{{ route('contracts.edit', $propertyActiveContract[0]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>                                      
                                    </a>
                                    <a title="Remover Contrato" href="{{ route('contracts.delete', $propertyActiveContract[0]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>                                                                     
                                    </a>
                                </div>
                            </td>
                        </tr>                
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="mt-5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-5">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-5">Contrato Antigos</h2>
                @if ($PropertyDisabledContracts->isEmpty())
                    <p class="text-gray-900 dark:text-gray-100">A Propriedade não possui Contratos Antigos</p>
                @else
                    <table class="table-fixed w-full border-collapse border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-800 border-rounded">
                        <thead>
                            <tr>
                                <th class="border border-slate-300 dark:border-slate-600 font-semibold p-2 text-slate-900 dark:text-slate-200 text-left">ID</th>
                                <th class="border border-slate-300 dark:border-slate-600 font-semibold p-2 text-slate-900 dark:text-slate-200 text-left">Data de Inicio</th>
                                <th class="border border-slate-300 dark:border-slate-600 font-semibold p-2 text-slate-900 dark:text-slate-200 text-left">Data de Termino</th>
                                <th class="border border-slate-300 dark:border-slate-600 font-semibold p-2 text-slate-900 dark:text-slate-200 text-left">Período do Contrato</th>
                                <th class="border border-slate-300 dark:border-slate-600 font-semibold p-2 text-slate-900 dark:text-slate-200 text-left">Valor do Aluguel</th>
                                <th class="border border-slate-300 dark:border-slate-600 font-semibold p-2 text-slate-900 dark:text-slate-200 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $PropertyDisabledContracts as $item )                                    
                                <tr>
                                    <td class="border border-slate-300 dark:border-slate-700 p-2 text-slate-500 dark:text-slate-400">{{$item->id}}</td>
                                    <td class="border border-slate-300 dark:border-slate-700 p-2 text-slate-500 dark:text-slate-400">{{$item->getFormattedDate($item->start_date)}}</td>
                                    <td class="border border-slate-300 dark:border-slate-700 p-2 text-slate-500 dark:text-slate-400">{{$item->getFormattedDate($item->end_date)}}</td>
                                    <td class="border border-slate-300 dark:border-slate-700 p-2 text-slate-500 dark:text-slate-400">{{$item->getContractTimeRemaing($item->start_date)}}</td>
                                    <td class="border border-slate-300 dark:border-slate-700 p-2 text-slate-500 dark:text-slate-400">{{$item->formatted_price}}</td>
                                    <td class="border border-slate-300 dark:border-slate-700 p-2 text-slate-500 dark:text-slate-400">{{($item->active_contract) ? 'Ativo' : 'Desativado'}}</td>
                                </tr>                
                            @endforeach
                        </tbody>
                    </table>                
                @endif
            </div>        
        </div>
    </div>
</x-app-layout>
