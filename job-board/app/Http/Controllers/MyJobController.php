<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Work as Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dump(auth()->user());
        $applicants = auth()->user()->jobApplications()->with(
            [
                'job' => fn($query) => $query->withTrashed()
            ]
        )->latest()->get();

         return view("auth.my-job-applicant.index",compact(var_name: "applicants"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(JobApplication $jobsapplication)
    {
        $jobsapplication->delete();
        return redirect()->back()->with("success","your job application canceled successfully !");
    }
}
