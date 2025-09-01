

{{-- This line assumes you are using the default Breeze layout --}}
{{-- If you create a separate admin layout later, you might change this --}}
<x-app-layout>
    {{-- Header Slot (Common in Breeze layouts) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    {{-- Main Content Area --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Link back to events list (optional but good practice) --}}
                    <div class="mb-4">
                        <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:text-blue-800">
                            &larr; Back to Events List
                        </a>
                    </div>

                    {{-- The Form --}}
                    {{-- Action points to the 'store' method defined by Route::resource --}}
                    <form method="POST" action="{{ route('admin.events.store') }}">
                        {{-- CSRF Token - VERY IMPORTANT for security --}}
                        @csrf

                        {{-- Event Title --}}
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
                            <input type="text" name="title" id="title"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('title') border-red-500 @enderror"
                                   value="{{ old('title') }}" {{-- old() keeps value after validation error --}}
                                   required>
                            {{-- Display validation error for 'title' --}}
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Event Description --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('description') border-red-500 @enderror"
                                      required>{{ old('description') }}</textarea>
                             {{-- Display validation error for 'description' --}}
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Event Date --}}
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" id="date"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('date') border-red-500 @enderror"
                                   value="{{ old('date') }}"
                                   required>
                            {{-- Display validation error for 'date' --}}
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Event Time --}}
                        <div class="mb-4">
                            <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                            <input type="time" name="time" id="time"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('time') border-red-500 @enderror"
                                   value="{{ old('time') }}"
                                   required>
                            {{-- Display validation error for 'time' --}}
                            @error('time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Event Venue --}}
                        <div class="mb-4">
                            <label for="venue" class="block text-sm font-medium text-gray-700">Venue</label>
                            <input type="text" name="venue" id="venue"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('venue') border-red-500 @enderror"
                                   value="{{ old('venue') }}"
                                   required>
                            {{-- Display validation error for 'venue' --}}
                            @error('venue')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Event Capacity --}}
                        <div class="mb-6"> {{-- Slightly more margin before button --}}
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                            <input type="number" name="capacity" id="capacity" min="1" {{-- min="1" prevents zero or negative --}}
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('capacity') border-red-500 @enderror"
                                   value="{{ old('capacity') }}"
                                   required>
                             {{-- Display validation error for 'capacity' --}}
                            @error('capacity')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div>
                        <button type="submit"
                            style="background: red; color: white; padding: 10px;">
                            SUBMIT
                        </button>

                        </div>

                    </form> {{-- End of Form --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- /admin/events/create --}}

