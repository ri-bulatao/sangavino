<?php

namespace App\Http\Controllers\Guest;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('guest.announcement.index', [
            'announcements' => Announcement::with('media', 'comments')->latest()->get()
        ]);
    }
    
    public function show(Announcement $announcement)
    {
        return view('guest.announcement.show', ['announcement' => $announcement->load('media')]);
    }
}