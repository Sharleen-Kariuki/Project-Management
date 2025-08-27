<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $companyId = Auth::user()->company_id;




        $myPendingTasks = Task::query()
            ->where('status', 'pending')
            ->where('assigned_user_id', $user)
            ->whereHas('project', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->count();


        $myProgressTasks = Task::query()
            ->where('status', 'in_progress')
            ->where('assigned_user_id', $user)
            ->whereHas('project', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->count();

        $myCompletedTasks = Task::query()
            ->where('status', 'completed')
            ->where('assigned_user_id', $user)
            ->whereHas('project', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->count();

        // Total tasks
        $totalPendingTasks = Task::query()
            ->where('status', 'pending')
            ->whereHas('project', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->count();

        $totalProgressTasks = Task::query()
            ->where('status', 'in_progress')
            ->whereHas('project', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->count();

        $totalCompletedTasks = Task::query()
            ->where('status', 'completed')
            ->whereHas('project', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->count();

        $activeTasks = Task::query()
            ->whereIn('status', ['pending', 'in_progress'])
            ->where('assigned_user_id', $user)
            ->whereHas('project', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->limit(10)
            ->get();
        $activeTasks = TaskResource::collection($activeTasks);

        // dd(
        //     $myPendingTasks,
        //     $myProgressTasks,
        //     $myCompletedTasks,
        //     $totalPendingTasks,
        //     $totalProgressTasks,
        //     $totalCompletedTasks
        // );
        return inertia(
            'Dashboard',
            compact(
                'myPendingTasks',
                'myProgressTasks',
                'myCompletedTasks',
                'totalPendingTasks',
                'totalProgressTasks',
                'totalCompletedTasks',
                'activeTasks'
            )
        );
    }
}
