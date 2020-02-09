<?php

namespace App\Http\Controllers;

use App\Helpers\Find;
use App\Http\Requests\Notification as RequestsNotification;
use App\Http\Resources\Notification as ResourcesNotification;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function get(Request $request)
    {
        return ResourcesNotification::collection(Find::findAuthUser($request)->notifications);
    }

    public function getAll(Request $request)
    {
        return ResourcesNotification::collection(Notification::all());
    }

    public function read(Request $request)
    {
        Find::findAuthUser($request)->notifications()->where(['uid' => $request->uid])->update(['is_read' => true]);
        return ['message' => 'Successful'];
    }

    public function create(RequestsNotification $request)
    {
        $notification = Notification::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'uid' => (string) Str::random(10),
        ]);

        return new ResourcesNotification($notification);
    }
}
