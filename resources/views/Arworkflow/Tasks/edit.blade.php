<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>
                        @if ($task)
                            {!! $task->getFormularioRenderizado($token, $instance) !!}@csrf</form>
                        @else
                            @php
                                $url = route('requests.complete', ['request' => $instance->getId(), 'token' => $token]);
                            @endphp
                            <form action="{{ $url }}" method="POST">
                                @csrf
                                <button type="submit" class="p-3 text-white bg-green-500 rounded btn">Completar</button>
                            </form>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
