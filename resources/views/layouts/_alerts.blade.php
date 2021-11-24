@if (Session::has('error'))
    <div class="relative px-6 py-4 mb-4 text-white bg-red-500 border-0 rounded">
        <span class="inline-block mr-5 text-xl align-middle">
            <i class="fas fa-bell" />
        </span>
        <span class="inline-block mr-8 align-middle">
            <b class="capitalize">Algo Salió Mal!</b> {{ Session::get('message') }}
        </span>
        <button
            class="absolute top-0 right-0 mt-4 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none">
            <span>×</span>
        </button>
    </div>
@endif
@if (Session::has('success'))
    <div class="relative px-6 py-4 mb-4 text-white border-0 rounded bg-emerald-500">
        <span class="inline-block mr-5 text-xl align-middle">
            <i class="fas fa-bell" />
        </span>
        <span class="inline-block mr-8 align-middle">
            <b class="capitalize">Bien Hecho!</b> {{ Session::get('message') }}
        </span>
        <button
            class="absolute top-0 right-0 mt-4 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none">
            <span>×</span>
        </button>
    </div>
@endif
