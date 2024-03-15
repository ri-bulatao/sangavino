<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Announcement\AnnouncementRequest;
use App\Models\Announcement;
use App\Services\ImageUploadService;
use App\Services\TextService;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('admin.announcement.index', [
            'announcements' => Announcement::with('media', 'comments.user.resident')->latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.announcement.create');
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

       return to_route('admin.announcements.index')->with('success', 'Announcement Added Successfully');
    }

    public function show(Announcement $announcement)
    {
        return view('admin.announcement.show', ['announcement' => $announcement->load('media')]);
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', ['announcement' => $announcement->load('media')]);
    }

    public function update(AnnouncementRequest $request, Announcement $announcement, ImageUploadService $service)
    {
       $announcement->update($request->validated());

       if($request->image) 
       {
          $service->handleImageUpload(model:$announcement, images:$request->image, collection:'announcement_images', conversion_name:'card', action:'create');
       }

       return to_route('admin.announcements.index')->with('success', 'Announcement Updated Successfully');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return to_route('admin.announcements.index')->with('success', 'Announcement Updated Successfully');
    }
}