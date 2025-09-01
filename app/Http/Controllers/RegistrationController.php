<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request, \App\Models\Event $event)
{
    $user = auth()->user();

    if ($event->registrations()->where('user_id', $user->id)->exists()) {
        return back()->with('error', 'You already registered for this event.');
    }

    if ($event->registrations()->count() >= $event->capacity) {
        return back()->with('error', 'This event is full.');
    }

    $event->registrations()->create(['user_id' => $user->id]);

    return back()->with('success', 'You are registered!');
}

public function index()
{
    $registrations = auth()->user()->registrations()->with('event')->get();
    return view('registrations.my', compact('registrations'));
}

}
