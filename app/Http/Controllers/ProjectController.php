<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Doctor;
use App\Models\DoctorProject;
use App\Models\DoctorProjectPayed;
use App\Models\msg;
use App\Models\Project;
use App\Models\Sitting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projects = auth()->user()->projects;
        $projects = Project::all();
        $projects = project::orderBy('created_at', 'desc')->limit(8)->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $data = request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'age' => 'required|integer',
            // 'doctor_id',
            'nextdate',
        ]);
        if (request('description') == null) {
            $data['description'] = 'لا يوجد ملاحظات';
        } else {
            $data['description'] = request('description');
        }
        $data['doctor_id'] = request('doctor_id');
        $data['waiting'] = request()->has('waiting');
        $data['NewReg'] = request()->has('NewReg');
        $data['user_id'] = auth()->id();
        Project::create($data);



        $doctor = Doctor::find(request('doctor_id'));
        $project = Project::latest()->first();
        $project->doctors()->attach($doctor->id);


        if (request()->has('NewReg') != null) {
            $operation = DoctorProject::with(['transactions', 'doctor:id'])
                ->where('project_id', $project->id)
                ->first();
            DoctorProjectPayed::create([
                'doctor_project_id' => $operation->id,
                'payed' => 60
            ]);
        }
        return redirect('/projects')->with('message', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Comment $comment)
    {
        $prices = Sitting::get()->all();

        $num = Comment::where('project_id', $project->id)->get('num');
        $total = Comment::where('project_id', $project->id)->get()->sum('bill');
        $operations = DoctorProject::where('project_id', $project->id)->firstOrFail();
        $operation = DoctorProject::with(['transactions', 'doctor:id,name'])
            ->where('project_id', $project->id)
            ->first();
        $x = 1;
        $sum = 0;
        $first = null;
        if ($operation == null) {
            return view('projects.show', compact('project'));
        } else {
            $operation->transactions->each(function (DoctorProjectPayed $transaction) use ($operation) {
                $transaction->setRelation('doctorProject', $operation);
            });
            foreach ($operation->transactions as $transaction) {
                $sum += $transaction->payed;
                $first[] = $transaction->payed;
            }
            return view('projects.show', [
                'transactions' => $operation->transactions,
                'project' => $project,
                'operations' => $operations,
                'x' => $x,
                'sum' => $sum,
                'first' => $first,
                'total' => $total,
                'prices' =>$prices,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // abort_if(auth()->user()->id != $project->user_id, 403);
        return view('projects.edite', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = request()->validate([
            'name' => 'sometimes|required',
            'phone' => 'sometimes|required',
            'address' => 'sometimes|required',
            'age' => 'sometimes|required|integer',
            // 'description' => 'sometimes|required',
            'status' => 'sometimes|required',
            'nextdate' => 'sometimes|required',
            // 'case' => 'sometimes|required',
            // 'Bill' => 'sometimes|required'
        ]);
        if (request('description') == null) {
            $data['description'] = 'لا يوجد ملاحظات';
        } else {
            $data['description'] = request('description');
        }
        // dd($data['phone']);
        $data['waiting'] = request()->has('waiting');
        $project->update($data);
        return redirect('/projects/' . $project->id)->with('message', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect('/projects')->with('message', '');;
    }
}
