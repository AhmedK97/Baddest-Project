<?php

use App\Http\Controllers\CalculatedController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DailyDoctorExpensesController;
use App\Http\Controllers\DailyDoctorExpensesDeleController;
use App\Http\Controllers\DailyExpensesController;
use App\Http\Controllers\DailyExpensesDeleController;
use App\Http\Controllers\DentaldateController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorProjectPayedController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\LapController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\SittingController;
use App\Http\Controllers\TaskController;
use App\Models\Calculated;
use App\Models\Comment;
use App\Models\DailyDoctorExpenses;
use App\Models\DailyDoctorExpensesDele;
use App\Models\DailyExpenses;
use App\Models\DailyExpensesDele;
use App\Models\Doctor;
use App\Models\DoctorProject;
use App\Models\DoctorProjectPayed;
use App\Models\doctors;
use App\Models\Project;
use App\Models\Reg;
use App\Models\Sitting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

date_default_timezone_set('Africa/Cairo');


Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', function () {
    Auth::logout();
    return back();
});



Route::get('/users', function () {
    if (auth()->user()->admin == 2) {
        $users =  User::get()->all();
        $sitting = Sitting::get()->all();
        return view('/users', ['users' => $users, 'sitting' => $sitting]);
    } else
        return back();
})->middleware('auth');




Route::resource('/note', NoteController::class)->middleware('auth');


Route::get('/dele_user/{id}', function ($id) {
    User::where('id', $id)->delete();
    return back();
})->middleware('auth');

Route::resource('/lap', LapController::class)->middleware('auth');


Route::resource('/calculated', CalculatedController::class)->middleware('auth');



Route::get('/home', function (project $project) {
    $projects = $project->all();
    $count = Project::whereDate('nextdate', now()->format('Y-m-d'))->count();
    return view('home', ['projects' => $projects, 'count' => $count]);
})->middleware('auth');

Route::get('/hold', function (Project $project) {
    $projects = $project->all();
    return view('hold', compact('projects'));
})->middleware('auth');



Route::get('daily_custom', function () {
    $time = request('datetime');


    $operation = DoctorProject::with('transactions', 'doctor:id,name', 'project:id,name')->whereHas('transactions', function ($query) {
        return $query->whereDate('created_at', '=', request('datetime'));
    },)->get();

    return view('daily_custom', [
        'operation' => $operation,
        'time' => $time,

    ]);
})->middleware('auth');



Route::get('/daily', function (Project $project) {
    $time =   Carbon::today();

    $operation = DoctorProject::with('transactions', 'doctor:id,name', 'project:id,name')->whereHas('transactions', function ($query) {
        return $query->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'));
    },)->get();

    return view('daily', [

        'operation' => $operation,
        'time' => $time,

    ]);
})->middleware('auth');





Route::get('/monthly', function () {
    $time =   Carbon::today();
    $month = null;
    $year = null;
    if (request('datetime')) {

        $operation = DoctorProject::with('transactions', 'doctor:id,name', 'project:id,name')->whereHas('transactions', function ($query) {
            return $query->whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'))->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'));
        },)->get();

        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
    } else {
        $operation = DoctorProject::with('transactions', 'doctor:id,name', 'project:id,name')->whereHas('transactions', function ($query) {
            return $query->whereYear('created_at', Carbon::today()->year)->whereMonth('created_at',  Carbon::today()->month);
        },)->get();


        $month =   Carbon::today()->month;
        $year =   Carbon::today()->year;
    }

    return view('monthly', [

        'operation' => $operation,
        'time' => $time,
        'month' => $month,
        'year' => $year,

    ]);
})->middleware('auth');



Route::get('/combinations', function () {
    $s = 0;
    $ZIRCON_EMAX = 0;
    $ZIRCON = 0;
    $VENEER = 0;
    $EMAX = 0;
    $PORCELAIN = 0;
    $move = 0;
    if (request('datetime')) {
        $s = 0;
        $projects =  Project::whereHas('comments', function ($q) {
            $q->whereIn('comment', ['16', '17', '18', '19', '20', '13'])->whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'))->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'));
        })->get();

        foreach ($projects->where('doctor_id', request('doc-name')) as $project) {
            foreach ($project->comments as $comment) {

                if ($comment->comment == 16 && $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))

                    $ZIRCON_EMAX  += $comment->num;
                elseif ($comment->comment == 17 && $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))
                    $ZIRCON += $comment->num;
                elseif ($comment->comment == 18 && $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))
                    $EMAX += $comment->num;
                elseif ($comment->comment == 19 && $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))
                    $VENEER += $comment->num;
                elseif ($comment->comment == 20 && $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))
                    $PORCELAIN += $comment->num;
                elseif ($comment->comment == 13 && $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))
                    $move += $comment->num;
                else {
                }

                if ((($comment->comment == 16) || ($comment->comment == 17) || ($comment->comment == 13) || ($comment->comment == 18) || ($comment->comment == 19) || ($comment->comment == 20)) && $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m')) {
                    $s += $comment->bill;
                }
            }
        }

        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
    } else {
        $projects =  Project::whereHas('comments', function ($q) {
            $q->whereIn('comment', ['16', '17', '18', '19', '20'])->whereYear('created_at', Carbon::today()->year)->whereMonth('created_at',  Carbon::today()->month);
        })->get();

        foreach ($projects->where('doctor_id', request('doc-name')) as $project) {
            foreach ($project->comments as $comment) {
                if ($comment->comment == 16 && $comment->created_at->format('m') ==  Carbon::today()->month)
                    $ZIRCON_EMAX  += $comment->num;
                elseif ($comment->comment == 17 && $comment->created_at->format('m') ==  Carbon::today()->month)
                    $ZIRCON += $comment->num;
                elseif ($comment->comment == 18 && $comment->created_at->format('m') ==  Carbon::today()->month)
                    $EMAX += $comment->num;
                elseif ($comment->comment == 19 && $comment->created_at->format('m') ==  Carbon::today()->month)
                    $VENEER += $comment->num;
                elseif ($comment->comment == 20 && $comment->created_at->format('m') ==  Carbon::today()->month)
                    $PORCELAIN += $comment->num;
                elseif ($comment->comment == 13 && $comment->created_at->format('m') ==  Carbon::today()->month)
                    $move += $comment->num;
                else {
                }

                if ((($comment->comment == 16) || ($comment->comment == 17) || ($comment->comment == 13) || ($comment->comment == 18) || ($comment->comment == 19) || ($comment->comment == 20)) && $comment->created_at->format('m') ==  Carbon::today()->month) {
                    $s += $comment->bill;
                }
            }
        }

        $month =   Carbon::today()->month;
        $year =   Carbon::today()->year;
    }
    return view('combinations', [
        'projects' => $projects, 'month' => $month,
        'year' => $year,
        's' => $s,
        'ZIRCON_EMAX' => $ZIRCON_EMAX,
        'ZIRCON' => $ZIRCON,
        'VENEER' => $VENEER,
        'EMAX' => $EMAX,
        'PORCELAIN' => $PORCELAIN,
        'move' => $move
    ]);
})->middleware('auth');

Route::get('/gingival', function () {
    $s = 0;

    if (request('datetime')) {
        $s = 0;
        $projects =  Project::whereHas('comments', function ($q) {
            $q->where('comment', [2])->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))->whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'));
        })->get();

        foreach ($projects->where('doctor_id', request('doc-name')) as $project) {
            foreach ($project->comments as $comment) {

                if (($comment->comment == 2)  &&   $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m')) {
                    $s += $comment->bill;
                }
            }
        }
        // dd($projects);

        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
    } else {
        $projects =  Project::whereHas('comments', function ($q) {
            $q->where('comment', [2])->whereYear('created_at', Carbon::today()->year)->whereMonth('created_at',  Carbon::today()->month);
        })->get();

        foreach ($projects->where('doctor_id', request('doc-name')) as $project) {
            foreach ($project->comments as $comment) {

                if (($comment->comment == 2)  && $comment->created_at->format('m') ==  Carbon::today()->month) {
                    $s += $comment->bill;
                }
            }
        }

        $month =   Carbon::today()->month;
        $year =   Carbon::today()->year;
    }
    return view('gingival', [
        'projects' => $projects, 'month' => $month,
        'year' => $year,
        's' => $s,

    ]);
})->middleware('auth');


Route::get('/cosmetic', function () {
    $s = 0;

    if (request('datetime')) {
        $s = 0;
        $projects =  Project::whereHas('comments', function ($q) {
            $q->where('comment', [7])->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))->whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'));
        })->get();
        foreach ($projects->where('doctor_id', request('doc-name')) as $project) {
            foreach ($project->comments as $comment) {

                if (($comment->comment == 7)  &&   $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m')) {
                    $s += $comment->bill;
                }
            }
        }
        // dd($projects);

        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
    } else {
        $projects =  Project::whereHas('comments', function ($q) {
            $q->where('comment', [7])->whereYear('created_at', Carbon::today()->year)->whereMonth('created_at',  Carbon::today()->month);
        })->get();

        foreach ($projects->where('doctor_id', request('doc-name')) as $project) {
            foreach ($project->comments as $comment) {

                if (($comment->comment == 7)  && $comment->created_at->format('m') ==  Carbon::today()->month) {
                    $s += $comment->bill;
                }
            }
        }

        $month =   Carbon::today()->month;
        $year =   Carbon::today()->year;
    }
    return view('cosmetic', [
        'projects' => $projects, 'month' => $month,
        'year' => $year,
        's' => $s,

    ]);
})->middleware('auth');

Route::get('/teeth_distance', function () {
    $s = 0;


    if (request('datetime')) {
        $s = 0;
        $projects =  Project::whereHas('comments', function ($q) {
            $q->where('comment', [10])->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))->whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'));
        })->get();
        foreach ($projects->where('doctor_id', request('doc-name')) as $project) {
            foreach ($project->comments as $comment) {

                if (($comment->comment == 10)  &&   $comment->created_at->format('m') == Carbon::createFromFormat('Y-m', request('datetime'))->format('m')) {
                    $s += $comment->bill;
                }
            }
        }
        // dd($projects);

        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
    } else {
        $projects =  Project::whereHas('comments', function ($q) {
            $q->where('comment', [10])->whereYear('created_at', Carbon::today()->year)->whereMonth('created_at',  Carbon::today()->month);
        })->get();

        foreach ($projects->where('doctor_id', request('doc-name')) as $project) {
            foreach ($project->comments as $comment) {

                if (($comment->comment == 10)  && $comment->created_at->format('m') ==  Carbon::today()->month) {
                    $s += $comment->bill;
                }
            }
        }

        $month =   Carbon::today()->month;
        $year =   Carbon::today()->year;
    }
    return view('teeth_distance', [
        'projects' => $projects,
        'month' => $month,
        'year' => $year,
        's' => $s,

    ]);
})->middleware('auth');




Route::get('/TodayAttend', function (Project $project) {
    $count = Project::whereDate('nextdate', now()->format('Y-m-d'))->count();

    if (request('datetime')) {
        $date = request('datetime');
        $projects = $project->whereDate('nextdate', '=', request('datetime'))->get();
        // dd($projects);
        return view('TodayAttend', ['projects' => $projects, 'date' => $date, 'count' => $count]);
    } else {
        // dd((new DateTime));

        $projects = $project->whereDate('nextdate', '=', (new DateTime)->format('Y-m-d'))->get();
        return view('TodayAttend', compact('projects', 'count'));
    }
})->middleware('auth');


Route::get('/orthodontics', function () {
    $time =   Carbon::today();
    $month = null;
    $year = null;
    if (request('datetime')) {
        $operation = DoctorProject::with('transactions', 'doctor:id,name', 'project:id,name')->whereHas('transactions', function ($query) {
            return $query->whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'))->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'));
        },)->get();
        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
        $calc =   Calculated::where('month', $month . ' + ' . $year)->get()->all();
    } else {


        $operation = DoctorProject::with('transactions', 'doctor:id,name', 'project:id,name')->whereHas('transactions', function ($query) {
            return $query->whereYear('created_at', Carbon::today()->year)->whereMonth('created_at',  Carbon::today()->month);
        },)->get();
        $month =   Carbon::now()->format('m');
        $year =   Carbon::today()->year;
        $calc =   Calculated::where('month', $month . ' + ' . $year)->get()->all();
    }

    return view('orthodontics', [

        'operation' => $operation,
        'time' => $time,
        'month' => $month,
        'year' => $year,
        'calc' => $calc
    ]);
})->middleware('auth');



Route::resource('/daily_expenses', DailyExpensesController::class)->middleware('auth');


Route::resource('/daily_expenses_dele', DailyExpensesDeleController::class)->middleware('auth');


Route::resource('/daily_doctor_expenses', DailyDoctorExpensesController::class)->middleware('auth');


Route::resource('/daily_doctor_expenses_dele', DailyDoctorExpensesDeleController::class)->middleware('auth');


Route::get('/monthly_expenses', function () {
    if (request('datetime')) {
        $data =  DailyExpenses::whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'))->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))->get();
        $sum = $data->sum('bill');
        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
        return view('/monthly_expenses.index', ['data' => $data, 'sum' => $sum, 'month' => $month, 'year' => $year]);
    } else {
        $data =  DailyExpenses::whereMonth('created_at', Carbon::today()->month)->get();
        $sum = $data->sum('bill');
        return view('/monthly_expenses.index', ['data' => $data, 'sum' => $sum]);
    }
})->middleware('auth');

Route::get('/monthly_expenses_dele', function () {
    if (request('datetime')) {
        $data =  DailyExpensesDele::whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'))->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))->get();
        $sum = $data->sum('bill');
        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
        return view('/monthly_expenses_dele.index', ['data' => $data, 'sum' => $sum, 'month' => $month, 'year' => $year]);
    } else {
        $data =  DailyExpensesDele::whereMonth('created_at', Carbon::today()->month)->get();
        $sum = $data->sum('bill');
        return view('/monthly_expenses_dele.index', ['data' => $data, 'sum' => $sum]);
    }
})->middleware('auth');


Route::get('/monthly_doctor_expenses', function () {
    $doctors = Doctor::get()->all();
    $sumDoctor = 0;

    if (request('datetime')) {
        $data =  DailyDoctorExpenses::whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'))->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))->get();
        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
        $sum = $data->sum('bill');
        return view('/monthly_doctor_expenses.index', ['data' => $data, 'doctors' => $doctors, 'sum' => $sum, 'month' => $month, 'year' => $year, 'sumDoctor' => $sumDoctor]);
    } else {

        $data =  DailyDoctorExpenses::whereMonth('created_at', Carbon::today()->month)->get();
        $sum = $data->sum('bill');

        return view('/monthly_doctor_expenses.index', ['data' => $data, 'doctors' => $doctors, 'sum' => $sum, 'sumDoctor' => $sumDoctor]);
    }
})->middleware('auth');

Route::get('/monthly_doctor_expenses_dele', function () {
    $doctors = Doctor::get()->all();
    $sumDoctor = 0;

    if (request('datetime')) {
        $data =  DailyDoctorExpensesDele::whereYear('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('Y'))->whereMonth('created_at', Carbon::createFromFormat('Y-m', request('datetime'))->format('m'))->get();
        $month =   Carbon::createFromFormat('Y-m', request('datetime'))->format('m');
        $year =   Carbon::createFromFormat('Y-m', request('datetime'))->format('Y');
        $sum = $data->sum('bill');
        return view('/monthly_doctor_expenses_dele.index', ['data' => $data, 'doctors' => $doctors, 'sum' => $sum, 'month' => $month, 'year' => $year, 'sumDoctor' => $sumDoctor]);
    } else {

        $data =  DailyDoctorExpensesDele::whereMonth('created_at', Carbon::today()->month)->get();
        $sum = $data->sum('bill');

        return view('/monthly_doctor_expenses_dele.index', ['data' => $data, 'doctors' => $doctors, 'sum' => $sum, 'sumDoctor' => $sumDoctor]);
    }
})->middleware('auth');

// Route::resource('/doctors', DoctorController::class)->middleware('auth');

// Route::get('/delete_pay', function () {
//     echo 'ghjhjg';
// });

Route::resource('/Doctor_Project_Payed',  DoctorProjectPayedController::class)->middleware('auth');


Route::resource('projects/{project}/comment', CommentController::class)->middleware('auth');

Route::resource('/dentaldate', DentaldateController::class)->middleware('auth');

Auth::routes();

Route::resource('/projects', ProjectController::class)->middleware('auth');

Route::post('/projects/{project}/tasks', [TaskController::class, 'store']);

Route::patch('/projects/{project}/tasks/{task}', [TaskController::class, 'update']);

Route::delete('/projects/{project}/tasks/{task}', [TaskController::class, 'destroy']);

Route::get('/profile', [ProfileController::class, 'index']);

Route::patch('/profile', [ProfileController::class, 'update']);


Route::resource('/reg', RegController::class);

Route::get('/reg-done', function () {
    $regs =  Reg::where('status', 1)->orderBy('id', 'asc')->paginate(5);

    return view('reg-done.index', ['regs' => $regs]);
})->middleware('auth');
// C:\laragon\www\myprojects1\resources\views\


Route::get('/print', function () {

    $project = Project::where('id', request('id'))->get()->first();

    $name = request('name');
    $address = request('address');
    $phone = request('phone');
    $paid = request('paid');


    $total = request('total');
    // dd($total);
    return view('print.index', [
        'name' => $name, 'address' => $address, 'phone' => $phone, 'total' => $total, 'project' => $project, 'paid' => $paid
    ]);
});
Route::resource('/sitting', SittingController::class);


Route::get('/prices', function () {
    $sitting =  Sitting::get()->all();
    unset($sitting[0]);
    return view('/prices.index', ['sitting' => $sitting]);
});
