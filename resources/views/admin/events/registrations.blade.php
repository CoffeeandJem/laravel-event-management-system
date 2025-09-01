{{-- resources/views/admin/events/registrations.blade.php --}}
<x-app-layout>
    {{-- Header Slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-wrap">
            Registrations for: {{ $event->title }}
        </h2>
    </x-slot>

    {{-- Main Content Area --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Back Link --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.events.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            &larr; Back to Events List
                        </a>
                    </div>

                    {{-- Title and Count --}}
                    <h3 class="text-xl font-semibold mb-4 text-gray-900">
                        Registered Users
                        <span class="text-base font-normal text-gray-600">({{ $event->registrations->count() }} / {{ $event->capacity }})</span>
                    </h3>

                    {{-- Check if any registrations exist --}}
                    @if($event->registrations->isEmpty())
                        <p class="text-gray-500">No users have registered for this event yet.</p>
                    @else
                        {{-- Table Container for Responsiveness --}}
                        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered At</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    {{-- Loop through registrations. $event->load('registrations.user') in controller ensures user data is available --}}
                                    @foreach($event->registrations as $index => $registration)
                                        {{-- Check if the associated user exists --}}
                                        @if ($registration->user)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $registration->user->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $registration->user->email }}</td>
                                                {{-- Check if created_at is available and format it --}}
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $registration->created_at ? $registration->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                            </tr>
                                        @else
                                             {{-- Optional: Handle cases where user might be deleted --}}
                                             <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600" colspan="2">[User Deleted]</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $registration->created_at ? $registration->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                             </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>