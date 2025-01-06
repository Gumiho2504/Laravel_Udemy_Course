<x-app-layout>
    <x-bredcrumbs :links="
    [
        'Jobs' => route('jobs.index'),
        $job->title => route('jobs.show', $job),
        'Apply' => '#',
    ]
    " class="mb-4"></x-bredcrumbs>
    <x-job-card :$job></x-job-card>
    <x-card>
       <h2 class=" mb-4 text-lg font-medium">You are applying for {{ $job->title }}</h2>
       <form action="{{route('jobs.application.store', $job)}}" method="POST">
        @csrf
        <label for="expected_salary" class="mb-2 block text-sm text-slate-900 font-medium">Expected Salary</label>
        <x-text-input type="number" name="expected_salary" />
        <x-button label="Apply" class="mt-4"/>
       </form>
    </x-card>
</x-app-layout>
