<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 mt-5">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Edit Announcement</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Update the information for this announcement</p>
        </div>

        <!-- Form Container -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <form action="{{ route('announcements.update', $announcement->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-6">
                    <label for="title"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $announcement->title) }}" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    @error('title')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea name="description" id="description" rows="5" required
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('description', $announcement->description) }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-6">
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price
                        ($)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $announcement->price) }}"
                           step="0.01" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    @error('price')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Picture -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current
                        Picture</label>
                    <div class="w-40 h-40 border border-gray-300 dark:border-gray-700 rounded-md overflow-hidden">
                        <img src="{{ asset('storage/' . $announcement->picture) }}" alt="{{ $announcement->title }}"
                             class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Picture Upload -->
                <div class="mb-6">
                    <label for="picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update
                        Picture</label>
                    <input type="file" name="picture" id="picture" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave empty to keep the current picture</p>
                    @error('picture')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select name="status" id="status" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>
                        <option
                            value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>
                            Published
                        </option>
                        <option
                            value="archived" {{ old('status', $announcement->status) == 'archived' ? 'selected' : '' }}>
                            Archived
                        </option>
                    </select>
                    @error('status')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('announcements.index') }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        Update Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
