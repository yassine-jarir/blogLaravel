<!-- announcements.blade.php -->
@extends('layouts.main')

@section('content')
    <div class="mb-8 pb-4 border-b border-gray-700">
        <h1 class="text-3xl font-bold mb-2">Announcements</h1>
        <p class="text-gray-400">Stay updated with the latest news and updates from our office.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($announcements as $announcement)
            <div
                class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-all hover:-translate-y-1 hover:shadow-xl">
                <div class="p-4 bg-black/10 border-b border-gray-700">
                    <h3 class="text-xl font-semibold">{{ $announcement->title }}</h3>
                </div>
                <div class="p-4">
                    <p class="text-gray-400 mb-4">{{ $announcement->description }}</p>
                </div>
                <div class="px-4 py-3 flex justify-between items-center border-t border-gray-700 text-sm text-gray-400">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $announcement->created_at->format('M d, Y') }}
                    </div>
                    <a href="{{ route('announcements.view', $announcement->id) }}"
                       class="text-blue-400 hover:text-blue-300">Read more</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
