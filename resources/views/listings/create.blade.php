<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Add new listing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('listings.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <textarea class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            name="description" id="description" rows="2">{{ old('description') }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="price" value="{{ __('Price') }}" />
                        <x-jet-input id="price" class="block mt-1 w-full" type="number" name="price"
                            :value="old('price')" />
                        <x-jet-input-error for="price" class="mt-2" />

                    </div>

                    <div class="mt-4">
                        <x-jet-label for="photo1" value="{{ __('Photo 1') }}" />
                        <x-jet-input class="block mt-1 w-full " type="file" name="photo1" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="photo2" value="{{ __('Photo 2') }}" />
                        <x-jet-input class="block mt-1 w-full " type="file" name="photo2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="photo3" value="{{ __('Photo 3') }}" />
                        <x-jet-input class="block mt-1 w-full " type="file" name="photo3" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="categories" value="{{ __('Category') }}" />
                        @foreach ($categories as $category)
                            <input type="checkbox"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                name="categories[]" value="{{ $category->id }}">
                            <label>{{ $category->name }}</label>
                            <br>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="categories" value="{{ __('Category') }}" />
                        @foreach ($colors as $color)
                            <input type="checkbox"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                name="colors[]" value="{{ $color->id }}">
                            <label>{{ $color->name }}</label>
                            <br>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="categories" value="{{ __('Category') }}" />
                        @foreach ($sizes as $size)
                            <input type="checkbox"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                name="sizes[]" value="{{ $size->id }}">
                            <label>{{ $size->name }}</label>
                            <br>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create new listing') }}
                        </x-jet-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
