<x-app-layout>
    <x-bredcrumbs :links="
    [
        'My Jobs' => route('my-jobs.index'),
        'Post' => '#'
    ]" />

    <x-card class="mt-8">
        <form action="{{route('my-jobs.store')}}" method="POST">
            @csrf
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">Job Title</x-label>
                    <x-text-input type="text" name="title" />
                </div>
                <div>
                    <x-label for="location" :required="true">Location</x-label>
                    <x-text-input type="text" name="location" />
                </div>
            </div>
            <div>
                <x-label for="salary" :required="true">Salary</x-label>
                <x-text-input type="number" name="salary" />
            </div>
            <div>
                <x-label for="description" :required="true" value>Description</x-label>
                <x-text-input type="textarea" name="description" />
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <x-label for="experience_levels"  :required="true" >Experinece</x-label>
                    <x-radio-group name="experience_levels" :options="\App\Models\Work::$experience_levels" :value="old('experience_levels')" :allOption="false"/>
                </div>
                <div>
                    <x-label for="category"  :required="true" >Category</x-label>
                    <x-radio-group name="category" :options="\App\Models\Work::$category" :allOption="false" :value="old('category')"/>
                </div>
            </div>
            <x-button label="Post Job" class="w-full" ></x-button>
        </form>
    </x-card>
</x-app-layout>
