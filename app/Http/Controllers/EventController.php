<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    // Show upcoming events on homepage
    public function index()
    {
        $events = Event::where('date', '>=', now())
            ->orderBy('date')
            ->get();

        return view('home', compact('events'));
    }

    // Show single event details
    /*public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }*/

    // --- TEMPORARY TEST VERSION of the show method ---
    public function show(Event $event)
    {
        // Comment out the original line:
        return view('events.show', compact('event'));

    }
    // --- END of temporary test version ---

}
