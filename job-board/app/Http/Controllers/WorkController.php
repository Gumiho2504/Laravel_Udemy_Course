<?php

namespace App\Http\Controllers;

use App\Models\Work as Job;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience_levels',
            'category',
        );

        $jobs = Job::filter($filters);

        //dump(request()->all());
        return view('jobs.index' , data: ['jobs' => $jobs->paginate(10)]);
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show',[
            'job'=> $job->load('employer')
        ]);
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
