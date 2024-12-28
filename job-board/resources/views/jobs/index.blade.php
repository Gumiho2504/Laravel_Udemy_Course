
<x-app-layout>
    <div class="text-3xl mb-4 font-semibold">Job List : </div>
    @foreach ($jobs as $job)
    <x-job-card class="mb-4" :$job>
       <x-link-button :href="route('jobs.show', $job)">View</x-link-button>
    </x-job-card>


        {{-- <h2>{{ $job->description }}</h2>
        <h2>{{$job->experience_lavels}}</h2>
        <h2>{{ $job->location }}</h2> --}}
    @endforeach
</x-app-layout>
