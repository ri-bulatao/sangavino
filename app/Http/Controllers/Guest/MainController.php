<?php

namespace App\Http\Controllers\Guest;

use App\Models\Official;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class MainController extends Controller
{
    public function __invoke()
    {
        return view('guest.main.home', [
            'announcements' => Announcement::with('media')->get(),
            'officials' => Official::with('position')->get(),
            'services' => Service::all()
        ]);
    }
}
