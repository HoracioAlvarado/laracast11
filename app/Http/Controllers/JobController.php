<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs'=> $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job) 
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store(Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
        
        $job->title = request('title');
        $job->salary = request('salary');
        $job->employer_id = 1;

        $job->save();

        Mail::to($job->employer->user)
            ->queue(new JobPosted($job));
    
        return redirect('/jobs/'. $job->id);
    }

    public function edit(Job $job) 
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
        
        $job->title = request('title');
        $job->salary = request('salary');
        $job->save();
    
        return redirect('/jobs/'. $job->id);
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect('/jobs');
    }
}
