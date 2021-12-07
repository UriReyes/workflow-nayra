<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Peticiones
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                                <h1 class="text-xl text-blue-600">Peticiones Solicitadas</h1>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Nombre
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Estatus
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Opciones</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($requests as $request)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            {{ $request->instance->getId() }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    <ul>
                                                        @foreach ($request->instance->getTokens() as $token)
                                                            <li>{{ $token->getName() }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    <span
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                        {{ $request->request->status }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                    <a href="{{ route('requests.show', ['request' => $request->instance->getId()]) }}"
                                                        class="text-green-600 hover:text-green-900">
                                                        <i class="fas fa-play"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $requests->links() }}
                                <h1 class="mt-10 text-xl text-blue-600">Peticiones Completadas</h1>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Datos Recolectados
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Estatus
                                            </th>
                                            {{-- <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Options</span>
                                                </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($requests_completed as $request)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            {{ $request->instance->getId() }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    <ul>
                                                        @foreach ($request->instance->getDataStore()->getData() as $key => $item)
                                                            <li>[{{ $key }}]:{{ $item }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    <span
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                        {{ $request->request->status }}
                                                    </span>
                                                </td>
                                                {{-- <td
                                                        class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                        <a href="{{ route('requests.show', ['request' => $request->instance->getId()]) }}"
                                                            class="text-green-600 hover:text-green-900">
                                                            <i class="fas fa-play"></i>
                                                        </a>
                                                    </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $requests_completed->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
