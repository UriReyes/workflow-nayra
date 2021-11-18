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
                                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                    Name
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($request->instance->getTokens() as $token)
                                                <tr>
                                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        <a
                                                            href="{{ route('tasks.edit', ['task' => $token->getId(), 'requestId' => $request->instance->getId()]) }}">
                                                            {{ $token->getOwnerElement()->getName() }}</a>
                                                    </td>
                                                    <td>
                                                        @if (in_array($token->getOwnerElement()->getBpmnElement()->localName, ['task', 'userTask']))
                                                            <a
                                                                href="{{ route('requests.complete', ['request' => $request->instance->getId(), 'token' => $token->getId()]) }}">Completar</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                {{-- <u>Properties</u>:
                                            <pre>{{ json_encode($token->getOwnerElement()->getProperty('screenRef'), JSON_PRETTY_PRINT) }}</pre> --}}
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
