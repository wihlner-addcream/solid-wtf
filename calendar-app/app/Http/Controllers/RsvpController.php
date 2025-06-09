<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Rsvp;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RsvpController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'status' => ['required', Rule::in(['yes', 'no', 'maybe'])],
        ]);
        $data['event_id'] = $event->id;

        return Rsvp::create($data);
    }
}
