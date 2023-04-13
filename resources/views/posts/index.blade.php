<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="">
                        <x-primary-button-link href="{{ route('posts.create') }}">
                            {{ __('Create post') }}
                        </x-primary-button-link>
                    </div>
                    <div class="mt-4">
                        <table class="w-full">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Excerpt</th>
                                <th>Published at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ Str::of($post->post)->limit() }}</td>
                                    <td>{{ $post->publish_date ?? 'Unpublished' }}</td>
                                    <td>
                                        <x-primary-button-link href="{{ route('posts.edit', $post) }}">
                                            {{ __('Edit') }}
                                        </x-primary-button-link>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button type="submit">
                                                {{ __('Delete') }}
                                            </x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>