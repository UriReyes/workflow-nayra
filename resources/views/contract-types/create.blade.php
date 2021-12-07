<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tipos de contratos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col items-center justify-center py-5 bg-gray-50">
                        <div
                            class="flex flex-col w-full max-w-md px-4 py-8 bg-white shadow-md sm:px-6 md:px-8 lg:px-10 rounded-3xl">
                            <div class="self-center text-xl font-medium text-gray-800 sm:text-3xl">
                                Tipo de contratos
                            </div>
                            <div class="self-center mt-4 text-xl text-gray-800 sm:text-sm">
                                Ingresa la siguiente información
                            </div>

                            <div class="mt-10">
                                <form action="{{ route('contract-type.store') }}" method="POST">
                                    @csrf
                                    @include('contract-types._form')
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
