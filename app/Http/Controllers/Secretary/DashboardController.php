<?php

namespace App\Http\Controllers\Secretary;

use App\Models\User;
use App\Models\Blotter;
use App\Models\Request;
use App\Models\Service;
use App\Models\Resident;
use App\Models\Admin\Role;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }

    public function __invoke()
    {
        $announcements = Announcement::query();
        $blotters = Blotter::query();
        $residents = Resident::all();
        $users = User::byRole('resident');

        return view('secretary.dashboard.index', [
            'announcements' => $announcements->with('media')->paginate(6),
            'blotters' => $blotters->paginate(6),
            'total_announcement' => $announcements->count(),
            'total_resident' => $residents->count(),
            'total_blotter' => $blotters->count(),
            'total_request' => Request::count(),
            'total_voter' => $residents->where('is_voter', true)->count(),
            'total_non_voter' => $residents->where('is_voter', false)->count(),
            'total_active_user' => $users->where('is_activated', true)->count(),
            'total_inactive_user' => $users->where('is_activated', false)->count(),
            'services_requests' => $this->getTotalRequestByService(),
            'monthly_users' => $this->getMonthlyUsers()
        ]);
    }

    public function getTotalRequestByService()
    {
        $services = [];
        $total_request = [];

        foreach (Service::with('requests')->get() as $service) {
            $services[] = $service->name;
            $total_request[] = $service->requests()->count();
        }

        return [$services, $total_request];
    }

    public function getMonthlyUsers()
    {
        $monthly_users = User::selectRaw("count(id) AS total_users,DATE_FORMAT(created_at, '%M-%Y') AS new_date,YEAR(created_at) AS year,monthname(created_at) AS month")
                        ->where('role_id', Role::RESIDENT)
                        ->groupBy('new_date')
                        ->get();

        $months = array();
        
        $total_monthly_users = array();

        foreach ($monthly_users as $month) {
            $months[] = $month->month;
        }

        foreach ($monthly_users as $total) {
            $total_monthly_users[] = $total->total_users;
        }

        return [$months, $total_monthly_users]; // sorted
    }
}