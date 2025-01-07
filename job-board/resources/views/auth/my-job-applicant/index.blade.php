<x-app-layout>
    <x-bredcrumbs :links="
    [
        'My Jobs Applicant' => '#',
    ]
    " />

<div class="mt-4">
    @forelse  ($applicants as $applicant)
    <x-job-card :job="$applicant->job" >
        <div class="flex items-center justify-between text-xs text-slate-500">
            <div>
                <div>
                    Applied {{$applicant->created_at->diffForHumans()}}
                </div>
                <div>
                    Other {{Str::plural('applicant',$applicant->job->jobApplications()->count())}} {{$applicant->job->jobApplications()->count()}}
                </div>
                <div>
                    expected salary ${{number_format($applicant->expected_salary)}}
                </div>
                <div>
                    Average Asking salary $ {{number_format($applicant->job->jobApplications()->average('expected_salary'))}}
                </div>
            </div>
            <div>
               <form action="{{route('jobsapplication.destroy',$applicant)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md text-sm">Cancel</button>
               </form>
            </div>
        </div>
    </x-job-card>
    @empty
        <div class="text-sm text-slate-500 fonts-medium">
            <div class=" rounded-sm border border-slate-300 p-3 mb-4">No Job Applicant!</div>
            <a href="{{route('jobs.index')}}" class=" text-blue-500 hover:underline">Go to find some jobs ➔ </a>
        </div>
    @endforelse
</div>



</x-app-layout>
