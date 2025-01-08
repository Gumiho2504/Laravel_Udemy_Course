<x-card class="mb-4">
    <div class="flex justify-between mb-4">
        <h2 class="text-lg font-medium">  {{ $job->title }}</h2>
        <h2 class="text-slate-500">${{number_format($job->salary)}}</h2>
    </div>
    <div class="mb-4 flex justify-between text-sm text-slate-500 items-center">
        <div class="flex space-x-4">
            <div>
                {{$job->employer->company_name}}
            </div>
            <div>{{$job->location}}</div>
            @if ($job->deleled_at)
                <div class="text-red-500">Deleled</div>
            @endif
        </div>

        <div class="flex space-x-1 text-xs">
            <x-tag>
                <a href="{{route('jobs.index', ['experience_levels' => $job->experience_levels])}}">{{Str::ucfirst($job->experience_levels)}}</a>
            </x-tag>
            <x-tag>
                <a href="{{route('jobs.index', ['category' => $job->category])}}">{{Str::ucfirst($job->category)}}</a>
            </x-tag>
        </div>
    </div>


  {{$slot}}

</x-card>
