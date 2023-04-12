<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="author_id" class="sr-only">Author</label>
                            <select name="author_id" id="author_id"
                                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('author_id') border-red-500 @enderror">
                                <option value="">Select author</option>
                                @foreach($authors as $id => $name)
                                    <option value="{{ $id }}" @selected(old('author_id', $post->user_id) === $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <livewire:post-content-per-language
                            :post="$post"/>

                        <div class="mb-4">
                            <label for="publish_date" class="sr-only">Published at</label>
                            <input type="datetime-local" name="publish_date" id="publish_date"
                                   placeholder="Published at"
                                   class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('publish_date') border-red-500 @enderror"
                                   value="{{ old('publish_date', $post->publish_date) }}">
                            @error('publish_date')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
