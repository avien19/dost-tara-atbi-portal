<x-community-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('community.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create New Post
                    </a>

                    @foreach($posts as $post)
                        <div class="mt-6 p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                            <p class="mt-2">{{ $post->content }}</p>
                            @if($post->photo)
                                <img src="{{ Storage::url($post->photo) }}" alt="Post image" class="mt-4 max-w-full h-auto">
                            @endif
                            <p class="mt-2 text-sm text-gray-500">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y H:i') }}</p>
                            @can('update', $post)
                                <a href="{{ route('community.edit', $post) }}" class="text-blue-500 hover:underline">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form action="{{ route('community.destroy', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            @endcan
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-community-layout>