<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Proceso
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('screens.store') }}" method="post" class="grid grid-cols-12">
                        @csrf
                        <div class="col-span-12">
                            <label for="name">Nombre <span class="text-red-500">*</span></label>
                            <input autocomplete="off"
                                class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm {{ $errors->has('name') ? 'border-red-500' : '' }}"
                                type="text" id="name" name="name" />
                            <p class="m-0 text-gray-500"><small>El nombre del formulario debe ser único</small></p>
                            @error('name')
                                <p class="text-red-500"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-span-12 mt-2">
                            <label for="description">Descripción</label> <span class="text-red-500">*</span></label>
                            <textarea
                                class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm {{ $errors->has('description') ? 'border-red-500' : '' }}"
                                type="text" id="description" name="description"></textarea>
                            <p class="m-0 text-gray-500"><small>Descripción del formulario</small></p>
                            @error('description')
                                <p class="text-red-500"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <button
                            class="col-span-2 col-start-11 p-1 text-white bg-green-500 rounded hover:bg-green-700"><i
                                class="mr-1 fas fa-save"></i>Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
