<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Rsvp;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'status' => 'required|string',
        ]);
        $data['event_id'] = $event->id;

        $rsvp = Rsvp::create($data);

        return response()->json($rsvp, 201);
    }
}
