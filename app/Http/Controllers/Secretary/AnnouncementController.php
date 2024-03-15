<?php

namespace App\Http\Controllers\Secretary;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\Announcement\AnnouncementRequest;
use App\Services\TextService;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('secretary.announcement.index', [
            'announcements' => Announcement::with('media', 'comments.user.resident')->latest()->get()
        ]);
    }

    public function create()
    {
        return view('secretary.announcement.create');
    }

    public function store(AnnouncementRequest $request, ImageUploadService $service, TextService $text_service)
    {
       $announcement = Announcement::create($request->validated());

       if($request->image) 
       {
          $service->handleImageUpload(model:$announcement, images:$request->image, collection:'announcement_images', conversion_name:'card', action:'create');
       }

       // if its true
       if($request->has_sms)
       {
            $text_service->send_announcement_sms($request->sms_announcement);
       }

       return to_route('secretary.announcements.index')->with('success', 'Announcement Added Successfully');
    }

    public function show(Announcement $announcement)
    {
        return view('secretary.announcement.show', ['announcement' => $announcement->load('media')]);
    }

    public function edit(Announcement $announcement)
    {
        return view('secretary.announcement.edit', ['announcement' => $announcement->load('media')]);
    }

    public function update(AnnouncementRequest $request, Announcement $announcement, ImageUploadService $service)
    {
       $announcement->update($request->validated());

       if($request->image) 
       {
          $service->handleImageUpload(model:$announcement, images:$request->image, collection:'announcement_images', conversion_name:'card', action:'create');
       }

       return to_route('secretary.announcements.index')->with('success', 'Announcement Updated Successfully');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

       return to_route('secretary.announcements.index')->with('success', 'Announcement Updated Successfully');
    }
}