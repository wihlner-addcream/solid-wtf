<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return Event::with('rsvps')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $event = Event::create($data);

        return response()->json($event, 201);
    }

    public function show(Event $event)
    {
        return $event->load('rsvps');
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time',
        ]);

        $event->update($data);
        return $event;
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->noContent();
    }
}
