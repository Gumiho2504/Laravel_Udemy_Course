<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EmployerController extends Controller
{

    public function create()
    {
        Gate::authorize("create", Employer::class);
        return view("employer.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|min:3|unique:employers,company_name'
        ]);

        $user = auth()->user();
        $employer = $user->employer()->create([
            'company_name' => $request->input('company_name')
        ]);


        return redirect()->route('jobs.index')->with('success','You employer account was created!');
    }


}
