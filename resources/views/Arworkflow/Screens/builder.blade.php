<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Proceso
        </h2>
    </x-slot>
    <script>
        window.screenGlobalId = @json($screen->id);
    </script>
    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="bg-white border-b border-gray-200">
                <div style="height: calc(100% - 80px);">
                    <div id="app-screen-builder"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/constructorFormularios.js') }}"></script>
</x-app-layout>
