<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modificar una categoria') }}
        </h2>
    </x-slot>

    @include('components.alert')
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('category.update', $category->id) }}" method="post" class="mt-6 space-y-6" >
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="title" :value="__('Títol')" />
                            <x-text-input id="title" name="title" type="text" value="{{ $category->title }}" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="url_clean" :value="__('Url neta')" />
                            <x-text-input id="url_clean" name="url_clean" value="{{ $category->url_clean }}" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('url_clean')" class="mt-2" />
                        </div>
                        <input type="submit" value="Modificar" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>