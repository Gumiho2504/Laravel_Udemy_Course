<x-app-layout>

    <h1 class="py-16 text-4xl text-center font-medium">Sign in to your account</h1>
    <x-card class="w-1/2 mx-auto">
        <form action="{{route('auth.store')}}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="mb-2 block text-sm text-slate-900 font-medium" for="email">Email</label>
               <x-text-input name="email" placeholder="Enter email" type="email" />
               @error('email')
                  <p class="text-red-500">{{$message}}</p>
               @enderror
            </div>

            <div class="mb-4">
                <label class="mb-2 block text-sm text-slate-900 font-medium" for="password">Password</label>
               <x-text-input name="password" placeholder="Enter password" type="password" />
               @error('password')
               <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-8 flex justify-between text-sm font-medium">
                <div>
                    <input type="checkbox" name="remember" id="remember" class="rounded-lg border border-slate-300">
                    <label class="ml-2 text-sm font-medium text-slate-900" for="remember">Remember me</label>
                </div>

                <div>
                   <a href="#" class="text-indigo-600 hover:underline">Forget password?</a>
                </div>
            </div>

            <x-button label="Login" class="w-full"></x-button>

       </form>
    </x-card>
</x-app-layout>
