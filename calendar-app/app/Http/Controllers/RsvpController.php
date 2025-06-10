<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Rsvp;
use App\Http\Requests\StoreRsvpRequest;
use App\Http\Controllers\Controller;

class RsvpController extends Controller
{
    public function store(StoreRsvpRequest $request, Event $event)
    {
        $data = $request->validated();
        $data['event_id'] = $event->id;

        $rsvp = Rsvp::create($data);

        return response()->json($rsvp, 201);
    }
}
