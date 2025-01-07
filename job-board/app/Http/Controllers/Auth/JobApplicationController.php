<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work as Job;
use Illuminate\Support\Facades\Gate;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {

        Gate::authorize("apply", $job);

        return view(view: "auth.job_application.create" ,data:  ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job,Request $request)
    {
        $validatedData = $request->validate([
            'expected_salary'=> 'required|min:1|max:1000000',
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('cv');
        //$path = $file->storeAs('', $file->getClientOriginalName(),'');
        $path = $file->store('cvs','public');
        $job->jobApplications()->create(
            [

                'user_id' => $request->user()->id,
                'expected_salary' => $validatedData['expected_salary'],
                'cv_path' => $path,
            ]
        );

       // return redirect()->route('jobs.show',$job)
       return redirect()->route('jobsapplication.index',
       [
        'applicants' => auth()->user()->jobApplications()->latest()->get()
       ])
        ->with([
            'success'=> 'Your application has been sent successfully !'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
