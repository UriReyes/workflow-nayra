<x-app-layout>
    <script>
        window.processXML = @json($designer->bpmn_content);
        window.processIdentifier = @json($designer->id);
        window.diagramHasChanges = false;
        document.addEventListener('DOMContentLoaded', function() {
            window.onbeforeunload = function(event) {
                if (window.diagramHasChanges) {
                    return confirm("Confirm refresh");
                }
            };
        })
    </script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Diseñador
        </h2>
    </x-slot>
    <div class="w-full">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="bg-white border-b border-gray-200">
                <div id="app-modeler"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/modelador.js') }}"></script>
</x-app-layout>
