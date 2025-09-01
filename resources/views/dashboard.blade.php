<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Display Upcoming Events -->
            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-lg font-medium mb-4">Upcoming Events</h3>
                @forelse ($upcomingEvents as $event)
                    <div class="border-b py-2">
                        <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:underline">
                            {{ $event->title }} - {{ $event->date->format('M d, Y') }}
                        </a>
                    </div>
                @empty
                    <p>No upcoming events.</p>
                @endforelse
            </div>

            <!-- Display Registered Events -->
            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-lg font-medium mb-4">My Registered Events</h3>
                @forelse ($registeredEvents as $registration)
                    <div class="border-b py-2">
                        {{ $registration->event->title }} - {{ $registration->event->date->format('M d, Y') }}
                    </div>
                @empty
                    <p>You have not registered for any events yet.</p>
                @endforelse
            </div>
            
        </div>
    </div>
</x-app-layout>
