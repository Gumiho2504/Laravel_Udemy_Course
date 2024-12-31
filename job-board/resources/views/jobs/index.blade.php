@props(['levels' => ['internship','entry', 'intermediate','junior', 'senior']])

<x-app-layout>

    <x-bredcrumbs  class="mb-4" :links="[
        'Jobs' => route('jobs.index'),
    ]" />

    <x-card class="mb-4 text-sm">
        <form action="{{route('jobs.index')}}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" placeholder="Search for any text" value="{{request('search')}}"/>

                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" placeholder="From" value="{{request('min_salary')}}"/>
                        <x-text-input name="max_salary" placeholder="To" value="{{request('max_salary')}}"/>
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience Level</div>
                    <x-radio-group name="experience_level" :options="\App\Models\Work::$experience_levels"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category" :options="\App\Models\Work::$category"/>
                </div>
            </div>
            <button class="w-full text-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Filter</button>
        </form>
    </x-card>

    <div class="text-3xl mb-4 font-semibold">Job List : </div>
    <div class="mb-2 text-sm text-slate-500"> result : {{count($jobs)}} {{Str::plural("job", count($jobs))}} </div>
    @forelse ($jobs as $job)
        <x-job-card class="mb-4" :$job>
        <x-link-button :href="route('jobs.show', $job)">View</x-link-button>
        </x-job-card>
    @empty
        <x-card>
            <div class="text-slate-500 text-center">No job found</div>
        </x-card>
    @endforelse ($jobs as $job)



</x-app-layout>
