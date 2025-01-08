<x-app-layout>
    <x-bredcrumbs :links="
    [
        'My Jobs' => route('my-jobs.index'),
        $job->title => '#',
        'Edit' => '#'
    ]" />

    <x-card class="mt-8">
        <form action="{{route('my-jobs.update',$job)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">Job Title</x-label>
                    <x-text-input type="text" name="title" value="{{$job->title}}" />
                </div>
                <div>
                    <x-label for="location" :required="true">Location</x-label>
                    <x-text-input type="text" name="location" value="{{$job->location}}" />
                </div>
            </div>
            <div>
                <x-label for="salary" :required="true">Salary</x-label>
                <x-text-input type="number" name="salary" value="{{$job->salary}}" />
            </div>
            <div>
                <x-label for="description" :required="true">Description</x-label>
                <x-text-input type="textarea" name="description" value="{{$job->description}}"/>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <x-label for="experience_levels"  :required="true" >Experinece</x-label>
                    <x-radio-group name="experience_levels" :options="\App\Models\Work::$experience_levels" value="{{$job->experience_levels}}" :allOption="false"/>
                </div>
                <div>
                    <x-label for="category"  :required="true" >Category</x-label>
                    <x-radio-group name="category" :options="\App\Models\Work::$category" :allOption="false" value="{{$job->category}}" />
                </div>
            </div>
            <br>
            <x-button label="Update Job" class="w-full" ></x-button>
        </form>
    </x-card>
</x-app-layout>
