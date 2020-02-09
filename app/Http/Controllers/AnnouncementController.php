<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Helpers\Find;
use App\Http\Requests\Announcement as RequestsAnnouncement;
use App\Http\Resources\Announcement as ResourcesAnnouncement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function get(Request $request)
    {
        return ResourcesAnnouncement::collection(Announcement::all());
    }

    public function create(RequestsAnnouncement $request)
    {
        $announcement = Announcement::create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return new ResourcesAnnouncement($announcement);
    }
}
