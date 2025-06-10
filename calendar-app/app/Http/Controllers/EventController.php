<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query()->with('rsvps');

        if ($title = $request->query('title')) {
            $query->where('title', 'like', "%{$title}%");
        }

        if ($start = $request->query('start')) {
            $query->where('start_time', '>=', $start);
        }

        if ($end = $request->query('end')) {
            $query->where('end_time', '<=', $end);
        }

        return $query->get();
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

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
