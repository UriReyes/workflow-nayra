<x-app-layout>
    <script>
        window.processXML = @json($designer->bpmn);
        window.processIdentifier = @json($designer->id);
    </script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Diseñador
        </h2>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="bg-white border-b border-gray-200">
                <div id="app"></div>
                {{-- <div id="app-vue">
                        <example-component />
                    </div> --}}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
