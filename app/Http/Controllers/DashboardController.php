<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    { 
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Fetch upcoming events and user registrations
        $upcomingEvents = Event::where('date', '>=', now())->orderBy('date')->get();
        $registeredEvents = $user->registrations()->with('event')->get();

        return view('dashboard', compact('upcomingEvents', 'registeredEvents'));
    }
}
