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
        $jobs = Job::query();
        $jobs->when(request("search"), function ($query) {
            $query->where(function($query) {
                $query->where("title" ,"like" , "%".request('search')."%" )
                ->orWhere("description" ,"like" , "%".request('search')."%");
            });
        })->when(request('min_salary'),function($query){
            $query->where('salary','>=', request('min_salary'));
        })->when(request('max_salary'),callback: function($query){
            $query->where('salary','<=', request('max_salary'));
        })->when(request('experience_levels'),callback: function($query){
            $query->where('experience_levels', '=',request('experience_levels'));
        })->when(request('category'),function($query){
            $query->where('category','=', request('category'));
        });
        dump(request()->all());
        return view('jobs.index' , data: ['jobs' => $jobs->get()]);
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
        return view('jobs.show',compact('job'));
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
