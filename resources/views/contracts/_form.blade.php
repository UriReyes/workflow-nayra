<!-- Required form plugin -->
<link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet" />

<div class="flex flex-col mb-5">
    <label for="name" class="mb-1 text-xs tracking-wide text-gray-600">Nombre:</label>
    <div class="relative">
        <div class="absolute top-0 left-0 inline-flex items-center justify-center w-10 h-full text-gray-400 ">
            <i class="text-blue-500 fas fa-file-contract"></i>
        </div>

        <input id="name" type="name" name="name" autocomplete="off" value="{{ old('name', $contract->name) }}"
            class="w-full py-2 pl-10 pr-4 text-sm placeholder-gray-500 border border-gray-400 rounded focus:outline-none focus:border-blue-400"
            placeholder="" />
    </div>
</div>
<div class="flex flex-col mb-5">
    <label for="description" class="mb-1 text-xs tracking-wide text-gray-600">Descripción</label>
    <div class="relative">
        <div class="absolute top-0 left-0 inline-flex items-center justify-center w-10 h-full text-gray-400 ">
            <i class="text-blue-500 fas fa-pen"></i>
        </div>
        <textarea id="description" name="description"
            class="w-full py-2 pl-10 pr-4 text-sm placeholder-gray-500 border border-gray-400 rounded focus:outline-none focus:border-blue-400">{{ old('description', $contract->description) }}</textarea>
    </div>
</div>
<div class="flex flex-col mb-5">
    <label for="">Archivo</label>
    <input type="file" name="file" />
</div>
{{-- <div class="flex flex-col mb-5">
    <label for="">Estatus</label>
    <select name="status">
        <option value="" disabled selected>Selecciona un estatus</option>
        @foreach (App\Models\Contract::STATUSES as $status)
            <option value="{{ $status }}">{{ $status }}</option>
        @endforeach
    </select>
</div> --}}

<div class="flex flex-col mb-6">
    <label for="process_id" class="mb-1 text-xs tracking-wide text-gray-600 sm:text-sm">Tipos de contrato:</label>
    <div class="relative">
        @if ($contractTypes->count() > 0)
            <div class="absolute top-0 left-0 inline-flex items-center justify-center w-10 h-full text-gray-400 ">
                <span>
                    <i class="text-blue-500 fas fa-lock"></i>
                </span>
            </div>
            <select name="contract_type_id" id="process_id"
                class="w-full py-2 pl-10 pr-4 text-sm placeholder-gray-500 border border-gray-400 rounded focus:outline-none focus:border-blue-400">
                @foreach ($contractTypes as $contractType)
                    <option value="{{ $contractType->id }}"
                        {{ old('contract_type_id', $contractType->contract_type_id) == $contractType->id ? 'selected' : '' }}>
                        {{ $contractType->name }}</option>
                @endforeach
            </select>
        @else
            <a class="text-sm text-gray-500"> <i class="mr-2 fas fa-exclamation-circle"></i>No hay
                tipos de contrato
                creados</a>
        @endif
    </div>
</div>

<div class="flex w-full">
    <button type="submit"
        class="flex items-center justify-center w-full py-2 mt-2 text-sm text-white transition duration-150 ease-in bg-blue-500 focus:outline-none sm:text-base hover:bg-blue-600 rounded-2xl">
        <span class="mr-2 uppercase">Guardar cambios</span>
        <span>
            <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                viewBox="0 0 24 24" stroke="currentColor">
                <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </span>
    </button>
</div>
