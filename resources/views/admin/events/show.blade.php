{{-- resources/views/events/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        {{-- Use text-wrap if event title is long --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-wrap">
            Event Details: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-4">

                    {{-- Back Links --}}
                    <div class="mb-4">
                         <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800 mr-4">&larr; Back to Dashboard</a>
                         <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Homepage</a>
                    </div>

                    {{-- Event Title --}}
                    <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>

                    {{-- Event Meta Details --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 border-y py-3">
                        {{-- Assumes $casts is set for 'date' in Event model --}}
                        <div><strong class="text-gray-800">Date:</strong> {{ $event->date->format('l, F j, Y') }}</div>
                         {{-- Format time nicely using Carbon. Assumes 'time' column holds HH:MM:SS or similar --}}
                        <div><strong class="text-gray-800">Time:</strong> {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}</div>
                        <div><strong class="text-gray-800">Venue:</strong> {{ $event->venue }}</div>
                    </div>

                    {{-- Event Description --}}
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold border-b pb-1 mb-2 text-gray-800">Description</h3>
                        {{-- Use prose for nice formatting, nl2br for newlines, e() for safety --}}
                        <div class="prose prose-sm max-w-none text-gray-700">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>

                    {{-- Capacity Info --}}
                    <div class="mt-4 text-sm text-gray-700">
                        <strong class="text-gray-800">Capacity:</strong> {{ $event->capacity }}
                         {{-- Calculate remaining spots --}}
                         @php
                             $registeredCount = $event->registrations()->count();
                             $remainingSpots = $event->capacity - $registeredCount;
                         @endphp
                         <span class="ml-4 text-gray-500">( {{ $remainingSpots >= 0 ? $remainingSpots : 0 }} spots remaining )</span>
                    </div>

                    <hr class="my-6">

                    {{-- Registration Section --}}
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-800">Register</h3>

                        {{-- Display Session Messages (Success/Error from Registration Attempt) --}}
                        @if(session('success'))
                            <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-300 rounded">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Registration Logic/Button --}}
                        @auth {{-- User must be logged in --}}
                            @php
                                $isRegistered = $event->registrations()->where('user_id', auth()->id())->exists();
                                $isFull = $remainingSpots <= 0;
                                $isPast = $event->date->isPast();
                            @endphp

                            @if($isPast)
                                 <p class="text-gray-600 font-semibold">Registration is closed (Event has passed).</p>
                            @elseif($isRegistered)
                                <p class="text-green-600 font-semibold">You are already registered for this event.</p>
                            @elseif($isFull)
                                <p class="text-red-600 font-semibold">Sorry, this event is now full.</p>
                            @else
                                <form method="POST" action="{{ route('events.register', $event->id) }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Register Now
                                    </button>
                                </form>
                            @endif
                        @else {{-- User is a GUEST --}}
                             <p class="text-gray-700">
                                 Please <a href="{{ route('login', ['redirect' => url()->current()]) }}" class="text-indigo-600 hover:underline font-medium">log in</a>
                                 or <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">register</a>
                                 to sign up for this event.
                             </p>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
