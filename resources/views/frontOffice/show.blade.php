<!-- announcement-show.blade.php -->
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $announcement->created_at->format('M d, Y') }}</span>
                    </div>

                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ $announcement->author ?? 'Admin' }}</span>
                    </div>
                </div>
            </div>

            <!-- Announcement Content -->
            <div class="p-6">
                <div class="prose prose-invert max-w-none">
                    {!! $announcement->description !!}
                </div>
            </div>

            <!-- Comments Section -->
            <div class="p-6 bg-gray-850 border-t border-gray-700">
                <h3 class="text-xl font-semibold mb-6">Comments ({{ $announcement->comments->count() ?? 0 }})</h3>

                <!-- New Comment Form -->
                <form action="{{ route('announcements.comments.store', $announcement) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="mb-4">
                        <textarea name="content" rows="3"
                                  class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                  placeholder="Leave a comment..."></textarea>
                        @error('content')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-colors">
                            Post Comment
                        </button>
                    </div>
                </form>

                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse($announcement->comments ?? [] as $comment)
                        <div class="bg-gray-900 rounded-lg p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <div
                                        class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center text-gray-400">
                                        {{ substr($comment->user->name ?? 'Anonymous', 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-sm font-medium">{{ $comment->user->name ?? 'Anonymous' }}</h4>
                                        <span
                                            class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() ?? 'Just now' }}</span>
                                    </div>
                                    <div class="text-sm text-gray-300">
                                        {{ $comment->content }}
                                    </div>

                                    <!-- Comment Actions -->
                                    <div class="mt-3 flex items-center space-x-4">
                                        <button class="text-xs text-gray-400 hover:text-white flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            Reply
                                        </button>

                                        @if(auth()->check() && auth()->id() == $comment->user_id)
                                            <button class="text-xs text-gray-400 hover:text-white flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </button>

                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-xs text-red-400 hover:text-red-300 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Nested Replies (if any) -->
                            @if(isset($comment->replies) && count($comment->replies))
                                <div class="ml-14 mt-4 space-y-4">
                                    @foreach($comment->replies as $reply)
                                        <div class="bg-gray-850 rounded-lg p-3 border-l-2 border-gray-700">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 mr-3">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center text-gray-400 text-xs">
                                                        {{ substr($reply->user->name ?? 'Anonymous', 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="flex-grow">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <h4 class="text-xs font-medium">{{ $reply->user->name ?? 'Anonymous' }}</h4>
                                                        <span
                                                            class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() ?? 'Just now' }}</span>
                                                    </div>
                                                    <div class="text-xs text-gray-300">
                                                        {{ $reply->content }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 opacity-40"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p>No comments yet. Be the first to share your thoughts!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination (if needed) -->
                @if(isset($announcement->comments) && $announcement->comments->hasPages())
                    <div class="mt-6">
                        {{ $announcement->comments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
