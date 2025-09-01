<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events - {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Upcoming Events</h1>

        {{-- Optional: Add Login/Register Links if needed --}}
        <div class="absolute top-0 right-0 p-6 text-right">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900">Register</a>
                @endif
            @endauth
        </div>


        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                        <p class="text-sm text-gray-600 mb-1">
                            Date: {{ \Carbon\Carbon::parse($event->date)->format('D, M j, Y') }}
                        </p>
                        <p class="text-sm text-gray-600 mb-1">
                            Time: {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                        </p>
                        <p class="text-sm text-gray-600 mb-3">
                            Venue: {{ $event->venue }}
                        </p>
                        <p class="text-gray-700 mb-4">
                            {{ Str::limit($event->description, 100) }} {{-- Show limited description --}}
                        </p>
                        <a href="{{ route('events.show', $event->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            View Details &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="bg-white p-4 rounded-lg shadow text-center">No upcoming events found.</p>
        @endif

    </div>
</body>
</html>