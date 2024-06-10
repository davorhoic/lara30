<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;




Route::get('/', function () {
    return view('home');
});

// Jobs - Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Jobs - Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Jobs - Show
Route::get('/jobs/{id}', function ($id) {

    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Jobs - Store
Route::post('/jobs', function () {

    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Jobs - Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// Jobs - Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    // authorize (On hold)
    // update the job
    $job = Job::findOrFail($id);
    //     1. NAČIN postavljanjem svojstava
    $job->title = request('title');
    $job->salary = request('salary');
    $job->save();
    //     2. NAČIN slično kao STORE
    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);
    // persist
    // redirect to the job page
    return redirect("/jobs/$job->id");
});

// Jobs - Destroy
Route::delete('/jobs/{id}', function ($id) {
    //authorize (on Hold)
    //delete the Job
    Job::findOrFail($id)->delete();
    //redirect 
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
