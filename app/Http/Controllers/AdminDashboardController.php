<!-- <?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::id();
    //     $companyId = Auth::user()->company_id;

    //     $totalPendingTasks = Project::query()
    //         ->whereHas('tasks', function ($query) use ($user) {
    //             $query->where('status', 'pending')
    //                 ->where('assigned_user_id', $user);
    //         })
    //         ->where('company_id', $companyId)
    //         ->withCount(['tasks as total_pending_tasks' => function ($query) use ($user) {
    //             $query->where('status', 'pending')
    //                 ->where('assigned_user_id', $user);
    //         }])
    //         ->get()
    //         ->sum('total_pending_tasks');
    //     $myPendingTasks = Task::query()
    //         ->where('status', 'pending')
    //         ->where('assigned_user_id', $user)
    //         ->where('company_id', $companyId)
    //         ->count();

    //     $totalProgressTasks = Task::query()
    //         ->where('status', 'in_progress')
    //         ->where('company_id', $companyId)
    //         ->count();
    //     $myProgressTasks = Task::query()
    //         ->where('status', 'in_progress')
    //         ->where('assigned_user_id', $user)
    //         ->where('company_id', $companyId)
    //         ->count();

    //     $totalCompletedTasks = Task::query()
    //         ->where('status', 'completed')
    //         ->where('company_id', $companyId)
    //         ->count();
    //     $myCompletedTasks = Task::query()
    //         ->where('status', 'completed')
    //         ->where('assigned_user_id', $user)
    //         ->where('company_id', $companyId)
    //         ->count();

    //     $activeTasks = Task::query()
    //         ->whereIn('status', ['pending', 'in_progress'])
    //         ->where('assigned_user_id', $user)
    //         ->where('company_id', $companyId)
    //         ->limit(10)
    //         ->get();
    //     $activeTasks = TaskResource::collection($activeTasks);

        

    //     return inertia(
    //         'Dashboard',
    //         compact(
    //             'totalPendingTasks',
    //             'myPendingTasks',
    //             'totalProgressTasks',
    //             'myProgressTasks',
    //             'totalCompletedTasks',
    //             'myCompletedTasks',
    //             'activeTasks',
    //             'tasks'
    //         )
    //     );
    // }
} 
