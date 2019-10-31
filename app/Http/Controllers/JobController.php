<?php

namespace App\Http\Controllers;

use App\Company;
use App\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobPostRequest;
class JobController extends Controller
{
    public function index(){
        $jobs = Job::all()->take(10);
        return view('welcome',compact('jobs'));
    }
    public function show($id, Job $job){
        return view('jobs.show',compact('job'));
    }

    public function create(){
        return view('jobs.create');
    }
    public function store(JobPostRequest $request){
        $user_id = auth()->user()->id;
        $company = Company::where('user_id',$user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' =>request('title'),
            'slug' =>str_slug(request('title')),
            'roles' =>request('roles'),
            //'category_id' =>request('category'),
            'description' =>request('description'),
            'position' =>request('position'),
            'address' =>request('address'),
            'type' =>request('type'),
            'status' =>request('status'),
            'last_date' =>request('last_date'),
        ]);
        return redirect()->back()->with('message','Job Posted Successfully');
    }

    public function myjob(){
        $jobs = Job::where('user_id',auth()->user()->id)->get();
        return view('jobs.myjobs',compact('jobs'));
    }

    public function jobedit($id){
       $JobDetails = Job::findOrFail($id);
       return view('jobs.jobedit',compact('JobDetails'));
    }

    public function jobupdate($id){
        $job = Job::findOrFail($id);
        $job->title = request('title');
        $job->roles = request('roles');
        $job->last_date = request('last_date');
        $job->status = request('status');
        $job->address = request('address');
        $job->category_id = request('jobcategory');
        $job->position = request('position');
        $job->save();
        return redirect()->to('jobs/myjob')->with('message','Job Update Successfully');
    }
    
    public function jobDelete($id){
       $job = Job::findOrFail($id);
       $job->delete();
       //return redirect()->to('jobs/myjob');*/
       //echo "hello world";
    }











}
