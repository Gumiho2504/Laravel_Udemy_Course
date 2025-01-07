<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased container max-w-2xl mx-auto mt-4">

        <nav class="mb-8 flex justify-between text-lg font-medium">
            <ul class="flex space-x-2">
                <li>
                    <a href="{{route('jobs.index')}}">Home</a>
                </li>

            </ul>
            <ul class="flex space-x-2">
                @auth
                    <li>
                        <a href="{{route('jobsapplication.index')}}" class="pr-2">
                            {{auth()->user()->name ?? 'Anonymous'}} : Applicant
                        </a>
                    </li>
                    <li>
                        <a href="{{route('my-jobs.index')}}">MyJobs</a>
                    </li>
                    <li>
                        <form action="{{route('auth.destroy')}}" method="POST">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md text-sm">SignOut</button>
                        </form>
                    </li>
                @else
                    <a href="{{route('auth.create')}}" class="px-3 py-1 bg-indigo-500 text-white rounded-md text-sm">SingIn</a>
                @endauth
            </ul>


        </nav>

        @if (session()->has('success'))

            <div role="alert"
            class="my-8 rounded-md border-l-4 border-green-500 bg-green-50 p-4 text-green-700">
                <p class="font-bold">Success!</p>
                <p>{{session('success')}}</p>
            </div>

        @endif

        @if (session()->has('error'))

            <div role="alert"
            class="my-8 rounded-md border-l-4 border-red-500 bg-red-50 p-4 text-red-700">
                <p class="font-bold">Error!</p>
                <p>{{session('error')}}</p>
            </div>

        @endif



        {{$slot}}

    </body>
</html>
