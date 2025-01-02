<x-app-layout>
    <x-bredcrumbs  class="mb-4" :links="[
        'Jobs' => route('jobs.index'),
        $job->title => '#',
    ]" />
    <x-job-card class="mb-4" :$job>
        <p class="text-sm text-slate-500 mb-4">
            {!!nl2br(e($job->description))!!}
        </p>
    </x-job-card>

    @isset($job->employer->jobs)
    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">Open Jobs</h2>
        <div class="text-sm text-slate-500">
            @foreach ($job->employer->jobs as $job)
                <div class="mb-4 flex justify-between">
                    <div>
                        <div class="text-slate-500">
                            <a class="block" href="{{route('jobs.show', $job)}}">{{$job->title}}</a>
                        </div>

                        <div class="text-xs">
                            {{$job->created_at->diffForHumans()}}
                        </div>
                    </div>
                    <div class="text-xs">
                        ${{number_format($job->salary)}}
                    </div>
                </div>

            @endforeach
        </div>
    </x-card>
    @endisset

</x-app-layout>
