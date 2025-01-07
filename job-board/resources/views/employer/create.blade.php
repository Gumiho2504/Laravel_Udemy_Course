<x-app-layout>
    <x-card class=" w-1/2 mx-auto">
        <form action="{{route('employer.store')}}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label for="company_name" :required="true">Company Name</x-label>
                <x-text-input type="text" name="company_name"></x-text-input>
            </div>
            <x-button label="Create" class="w-full"></x-button>
        </form>
    </x-card>
</x-app-layout>
