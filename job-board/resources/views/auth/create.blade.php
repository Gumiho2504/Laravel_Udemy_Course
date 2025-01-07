<x-app-layout>

    <h1 class="py-16 text-4xl text-center font-medium">Sign in to your account</h1>
    <x-card class="w-1/2 mx-auto">
        <form action="{{route('auth.store')}}" method="POST">
            @csrf

            <div class="mb-4">
                <x-label c for="email" :required="true">Email</x-label>
               <x-text-input name="email" placeholder="Enter email" type="email" />

            </div>

            <div class="mb-4">
                <x-label for="password" :required="true">Password</x-label>
               <x-text-input name="password" placeholder="Enter password" type="password" />

            </div>

            <div class="mb-8 flex justify-between text-sm font-medium">
                <div>
                    <input type="checkbox" name="remember" id="remember" class="rounded-lg border border-slate-300">
                    <x-label for="remember">Remember me</x-label>
                </div>

                <div>
                   <a href="#" class="text-indigo-600 hover:underline">Forget password?</a>
                </div>
            </div>

            <x-button label="Login" class="w-full"></x-button>

       </form>
    </x-card>
</x-app-layout>
