<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Eluceo\iCal\Component\Calendar;
use Eluceo\iCal\Component\Event as IcsEvent;
use Eluceo\iCal\Property\Event\Organizer;

class EventIcsController extends Controller
{
    public function __invoke(Event $event)
    {
        $calendar = new Calendar(config('app.url'));
        $calendar->setMethod(Calendar::METHOD_REQUEST);

        $vEvent = new IcsEvent();
        $vEvent->setDtStart($event->start_time)
            ->setDtEnd($event->end_time)
            ->setSummary($event->title);

        if ($event->description) {
            $vEvent->setDescription($event->description);
        }

        $organizer = new Organizer(
            'mailto:' . config('mail.from.address'),
            ['CN' => config('mail.from.name')]
        );
        $vEvent->setOrganizer($organizer);
        $vEvent->addAttendee(
            'mailto:' . request('email', config('mail.from.address')),
            ['CN' => request('name', config('mail.from.name'))]
        );

        $calendar->addEvent($vEvent);

        return response($calendar->render(), 200, [
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="event-' . $event->id . '.ics"',
        ]);
    }
}
