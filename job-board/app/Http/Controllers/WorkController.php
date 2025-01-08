<?php

namespace App\Http\Controllers;

use App\Models\Work as Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize("viewAny",Job::class);
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


    public function show(Job $job)
    {
        return view('jobs.show',[
            'job'=> $job->load('employer')
        ]);
    }


}
