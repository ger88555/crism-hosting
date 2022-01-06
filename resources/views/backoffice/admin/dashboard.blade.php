<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Administración de CRISM
        </h2>
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex flex-col mt-8">
                    <div class="py-2 my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 container flex justify-center mx-auto">
                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg m-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-xs font-large leading-1 tracking-wider text-left text-gray-500 uppercase border-b border-gray-500 bg-gray-50">
                                            Nombre</th>
                                        <th
                                            class="px-6 py-3 text-xs font-large leading-1 tracking-wider text-left text-gray-500 uppercase border-b border-gray-500 bg-gray-50">
                                            Usuario</th>
                                        <th
                                            class="px-6 py-3 text-xs font-large leading-1 tracking-wider text-left text-gray-500 uppercase border-b border-gray-500 bg-gray-50">
                                            Dominio</th>
                                        <th
                                            class="px-6 py-3 text-xs font-large leading-1 tracking-wider text-left text-gray-500 uppercase border-b border-gray-500 bg-gray-50">
                                            Correo</th>
                                        <th
                                            class="px-6 py-3 text-xs font-large leading-1 tracking-wider text-left text-gray-500 uppercase border-b border-gray-500 bg-gray-50">
                                            Miembro desde</th>
                                    </tr>
                                </thead>
                
                                <tbody class="bg-white">

                                    
                                    @forelse ($customers as $c)
                                        <tr>
                
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm leading-5 text-gray-500">{{ $c->name }} {{ $c->last_name }} {{ $c->second_last_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm leading-5 text-gray-500">{{ $c->username }}</div>
                                            </td>

                                            @if ($c->plan)
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-500">

                                                        @if ($c->domain)
                                                            <a class="underline" href="{{ $c->domain->absolute_url }}">{{ $c->domain->absolute_url }}</a>
                                                        @else
                                                            N/A
                                                        @endif

                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-500">

                                                        @if ($c->email)
                                                            <a class="underline" href="{{ $c->email->full_address }}">{{ $c->email->full_address }}</a>
                                                        @else
                                                            N/A
                                                        @endif

                                                    </div>
                                                </td>

                                            @else
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 bg-gray-100" colspan="2">
                                                    <div class="leading-5 text-gray-500 text-center">
                                                        Sin Plan
                                                    </div>
                                                </td>

                                            @endif

                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm leading-5 text-gray-500">
                                                    {{ $c->created_at->format('d-m-Y h:ia') }}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" colspan="5">
                                                <div class="text-sm leading-5 text-gray-500 text-center">
                                                    No hay clientes en el sistema.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
