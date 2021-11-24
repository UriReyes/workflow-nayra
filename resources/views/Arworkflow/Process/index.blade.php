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
                    <div class="grid grid-cols-12 mb-4">
                        <a class="w-full col-span-2 col-start-11 p-1 text-center text-white bg-green-600 border-green-900 border-solid rounded-sm cursor-pointer hover:bg-green-700"
                            title="Añadir Proceso" href="{{ route('process.create') }}"><i class="fas fa-plus"></i>
                            Proceso</a>
                    </div>
                    <hr>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Propietario
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Proceso
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Fecha de Creación
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Fecha de modificación
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($processes as $process)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 w-10 h-10">
                                                                <img class="w-10 h-10 rounded-full"
                                                                    src="https://i.pravatar.cc/300" alt="">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $process->created_by->name }}
                                                                </div>
                                                                <div class="text-sm text-gray-500">
                                                                    {{ $process->created_by->email }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">
                                                            {{ $process->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ Str::limit($process->description, 15, '...') }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $process->created_at->format('m-d-Y h:i A') }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $process->updated_at->format('m-d-Y h:i A') }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                        <a href="{{ route('designer.edit', ['designer' => $process->id]) }}"
                                                            class="text-blue-600 hover:text-indigo-900"
                                                            title="Editar Diseño">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div id="app"></div>
                    <div id="app-vue">
                        <example-component />
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
