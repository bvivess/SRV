<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Llistat de posts') }}
        </h2>
        <nav class="bg-gray-800">
            <ul class="flex justify-center space-x-4 p-4">
                <li><a href=href="{{route('post.index')}}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Posts</a></li>
                <li><a href="{{route('category.index')}}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Categories</a></li>
        </ul>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div><a href="{{route('post.create')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Nou Post</a></div>
                
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @each('components.cards-posts', $posts, 'post')

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>