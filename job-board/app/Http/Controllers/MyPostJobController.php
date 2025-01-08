<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Work as Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MyPostJobController extends Controller
{
    public function index()
    {
        Gate::authorize("viewAnyEmployer", Job::class);
        $jobs = auth()->user()->employer->jobs()->withTrashed()->latest()->get();
        return view('my-job.index',compact('jobs'));
    }


/******  b77d243c-96c1-49d1-b996-aa339ac29eef  *******/
    public function create()
    {
        Gate::authorize('create', Job::class);
        return view('my-job.create');
    }


    public function store(JobRequest $request)
    {

        Gate::authorize('create');
        auth()->user()->employer->jobs()->create($request->validated());
        return redirect()->route('my-jobs.index')
            ->with('success','Job created successfully!');
    }


    public function edit(Job $myJob)
    {
        Gate::authorize('update', $myJob);
        $job = $myJob;
        return view('my-job.edit',compact('job'));
    }


    public function update(JobRequest $request, Job $myJob)
    {

        Gate::authorize('update');
        $myJob->update(attributes: $request->validated());
        return redirect()->route('my-jobs.index')
            ->with('success',value: 'Job update successfully!');
    }


    public function destroy(Job $myJob)
    {
        Gate::authorize('delete', $myJob);
        $myJob->delete();
        return redirect()->route('my-jobs.index')
        ->with('success',value: 'Job deleted successfully!');
    }

}
