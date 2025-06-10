<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\EventIcsController;

Route::apiResource('events', EventController::class);
Route::post('events/{event}/rsvp', [RsvpController::class, 'store']);
Route::get('events/{event}/ics', EventIcsController::class);
