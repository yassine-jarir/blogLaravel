@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex mb-6 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span class="mx-2">/</span>
            <a href="#" class="hover:text-white transition-colors">Announcements</a>
            <span class="mx-2">/</span>
            <span class="text-gray-300">{{ $announcement->title }}</span>
        </nav>

        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <!-- Announcement Header -->
            <div class="p-6 bg-black/10 border-b border-gray-700">
                <h1 class="text-2xl md:text-3xl font-bold">{{ $announcement->title }}</h1>
                <div class="flex items-center mt-4 text-sm text-gray-400">
                    <div class="flex items-center mr-6">
                        <span>{{ $announcement->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <span>{{ $announcement->author ?? 'Admin' }}</span>
                    </div>
                </div>
            </div>

            <!-- Announcement Image -->
            @if($announcement->picture)
                <img src="{{ asset('storage/images/react.jpg') }}" alt="{{ $announcement->title }}" class="w-full h-64 object-cover">
            @else
                <div class="w-full h-64 bg-gray-700 flex items-center justify-center text-gray-400">
                    No image available
                </div>
            @endif

            <!-- Announcement Content -->
            <div class="p-6">
                <div class="prose prose-invert max-w-none">
                    {!! $announcement->description !!}
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-8 bg-gray-800 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold text-gray-100 mb-4">Comments</h2>
            <div class="space-y-4">
                @forelse($announcement->comments as $comment)
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-gray-100">{{ $comment->user->name }}</span>
                            <span class="text-sm text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-300">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p class="text-gray-400">No comments yet.</p>
                @endforelse
            </div>

            <!-- Comment Form -->
            @auth
                <form action="{{ route('announcements.comments.store', $announcement->id) }}" method="POST" class="mt-6">
                    @csrf
                    <textarea name="body" rows="3" class="w-full p-3 rounded-lg bg-gray-700 text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Write your comment here...">{{ old('body') }}</textarea>
                    @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Post Comment
                    </button>
                </form>
            @else
                <p class="text-gray-400 mt-4">You must be <a href="{{ route('login') }}" class="text-blue-400 hover:underline">logged in</a> to comment.</p>
            @endauth
        </div>
    </div>
@endsection
