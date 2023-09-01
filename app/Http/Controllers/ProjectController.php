<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at','desc')->get();
        $customers = Customer::all();
        return view('admin.project.index', compact('projects', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_name' => ['required', 'string', 'min:3', 'max:255'],
            'customer_id' => ['required'],
            'type' => ['required', 'string', 'in:Fixed,Hourly'],
            'cost' => ['required'],
        ]);
        $data['slug'] = Carbon::now()->timestamp;

        Project::create($data);
        return back()->with('status', 'A New Project has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $expenses = Expense::all();

        return view('admin.project.show', compact('project', 'expenses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('status', 'A Project has been Removed');
    }

    public function payment_store(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'min:3', 'max:255'],
            'date' => ['required'],
            'payment' => ['required', 'integer'],
            'description' => ['nullable', 'string', 'min:3', 'max:255'],
        ]);
        $data['slug'] = getSlug();
        $data['date'] = Carbon::parse($request->date)->setTimeFromTimeString(now()->toTimeString());

        if(!$request->title){
            $data['title'] = "Payment";
        }
        if(!$request->description){
            $data['description'] = "Payment has been added: ({$request->payment})";
        }



        $project->payments()->create($data);

        return back()->with('status', 'A Payment has been Added');

    }

    public function payment_delete($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return back()->with('status', 'A Payment has been Removed');
    }

    
}
