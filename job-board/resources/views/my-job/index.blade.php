<x-app-layout>
    <x-bredcrumbs :links="[
        'My Jobs' => route('my-jobs.index'),
    ]" />


    <br>

    <div class="mb-4 text-right">
        <x-link-button href="{{route('my-jobs.create')}}">Add Job</x-link-button>
    </div>

    @forelse ($jobs as $job)
    <x-job-card :$job>
        <div class="text-xs text-slate-500">
            @isset($job->jobApplications)
            <div class="mb-1">{{$job->jobApplications()->count() }}
                {{Str::plural('Apply', $job->jobApplications()->count())}}!</div>
            @endisset
            @forelse ($job->jobApplications as $application)
                <div class="mb-4 flex items-center justify-between border-b-2 border-blue-200 p-1">
                    <div>
                        <div>{{$application->user->name}}</div>
                        <div>Applied {{$application->created_at->diffForHumans()}}</div>
                        <div>
                            Dowload CV
                        </div>
                    </div>
                    <div>${{number_format($application->expected_salary)}}</div>
                </div>
            @empty
                <div>No application yet</div>
            @endforelse
        </div>
       <div class="mt-2 flex space-x-2">
            <x-link-button href="{{route('my-jobs.edit', $job)}} ">Edit</x-link-button>
            <form action="{{route('my-jobs.destroy',$job)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class=" px-2 py-2 bg-red-400 text-white font-medium rounded-lg hover:bg-red-500">Delete</button>
            </form>
       </div>
       </x-job-card>
    @empty
       <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">No jobs yet</div>
            <div class="text-center">
                Post your first job <a href="{{route('my-jobs.create')}}" class=" text-indigo-500 :hover:underline">here!</a>
            </div>
       </div>
    @endforelse
</x-app-layout>
