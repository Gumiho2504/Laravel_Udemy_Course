<!DOCTYPE html>
<html>

<head>
    <title>Task List App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- blade-formatter-disable --}}

    <style type="text/css">
        .btn {
            @apply rounded-md px-2 py-1 font-medium shadow-sm ring-1 ring-slate-700/10 text-slate-700 hover:bg-slate-50
        }

        .link {
            @apply font-medium text-gray-700 underline decoration-pink-500
        }
    </style>
    {{-- blade-formatter-disable --}}


</head>
@yield('styles')


<body class="container mx-auto mt-10 mb-10 max-w-lg">

    <h1 class="text-3xl mb-4">@yield('title')</h1>
    <div x-data="{ flash: true }">

        @if (session()->has('success'))
            <div x-show="flash"
                class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
                role="alert">

                <strong class="block">Success!</strong>
                <div>{{ session('success') }}</div>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        @click="flash = false" stroke="currentColor" class="h-6 w-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>
        @endif
        @yield('content')
    </div>
</body>



</html>
