<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="user_id" class="sr-only">Author</label>
                            <select name="user_id" id="user_id"
                                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('user_id') border-red-500 @enderror">
                                <option value="">Select author</option>
                                @foreach($authors as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @foreach(config('translatable.locales') as $locale)
                            <fieldset class="border-2 w-full p-4 rounded-lg mb-4">
                                <label>Text for {{ $locale }}</label>
                                <div class="mb-4">
                                    <label for="{{$locale}}[title]" class="sr-only">Title</label>
                                    <input type="text" name="{{$locale}}[title]" id="{{$locale}}[title]"
                                           placeholder="Title"
                                           class="bg-gray-100 border-2 w-full p-4 rounded-lg @error($locale.'.title') border-red-500 @enderror"
                                           value="{{ old($locale.'.title') }}">
                                    @error($locale.'.title')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="{{$locale}}[post]" class="sr-only">Body</label>
                                    <textarea name="{{$locale}}[post]" id="{{$locale}}[post]" cols="30" rows="4"
                                              placeholder="Post"
                                              class="bg-gray-100 border-2 w-full p-4 rounded-lg @error($locale.'.post') border-red-500 @enderror">{{ old($locale.'.post') }}</textarea>
                                    @error($locale.'.post')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </fieldset>
                        @endforeach

                        <div class="mb-4">
                            <label for="publish_date" class="sr-only">Published at</label>
                            <input type="datetime-local" name="publish_date" id="publish_date"
                                   placeholder="Published at"
                                   class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('publish_date') border-red-500 @enderror"
                                   value="{{ old('publish_date') }}">
                            @error('publish_date')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>