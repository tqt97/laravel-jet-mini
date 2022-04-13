<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Edit listing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('listings.update', $listing) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$listing->title" />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <textarea class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            name="description" id="description" rows="2">{!! $listing->description !!}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="price" value="{{ __('Price') }}" />
                        <x-jet-input id="price" class="block mt-1 w-full" type="number" name="price"
                            :value="$listing->price" />
                        <x-jet-input-error for="price" class="mt-2" />

                    </div>
                    <div class="mt-4">
                        <x-jet-label for="photo1" value="{{ __('Photo 1') }}" />
                        @if (isset($media[0]))
                            <div class="mt-2 mb-4">
                                <img src="{{ $media[0]->getUrl('thumb') }}" />
                                <a class="underline"
                                    href="{{ route('listings.deletePhoto', [$listing->id, $media[0]->id]) }}"
                                    onclick="return confirm('Are you sure?')">Delete photo</a>
                                <br />
                            </div>
                        @endif
                        <x-jet-input class="block mt-1 w-full " type="file" name="photo1" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="photo2" value="{{ __('Photo 2') }}" />
                        @if (isset($media[1]))
                            <div class="mt-2 mb-4">
                                <img src="{{ $media[1]->getUrl('thumb') }}" />
                                <a class="underline"
                                    href="{{ route('listings.deletePhoto', [$listing->id, $media[1]->id]) }}"
                                    onclick="return confirm('Are you sure?')">Delete photo</a>
                                <br />
                            </div>
                        @endif
                        <x-jet-input class="block mt-1 w-full " type="file" name="photo2" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="photo3" value="{{ __('Photo 3') }}" />
                        @if (isset($media[2]))
                            <div class="mt-2 mb-4">
                                <img src="{{ $media[2]->getUrl('thumb') }}" />
                                <a class="underline"
                                    href="{{ route('listings.deletePhoto', [$listing->id, $media[2]->id]) }}"
                                    onclick="return confirm('Are you sure?')">Delete photo</a>
                                <br />
                            </div>
                        @endif
                        <x-jet-input class="block mt-1 w-full " type="file" name="photo3" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="categories" value="{{ __('Category') }}" />
                        @foreach ($categories as $category)
                            <input type="checkbox"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                name="categories[]" value="{{ $category->id }}"
                                @if (in_array($category->id, $listing->categories->pluck('id')->toArray())) checked @endif>
                            <label>{{ $category->name }}</label>
                            <br>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="categories" value="{{ __('Category') }}" />
                        @foreach ($colors as $color)
                            <input type="checkbox"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                name="colors[]" value="{{ $color->id }}"
                                @if (in_array($color->id, $listing->colors->pluck('id')->toArray())) checked @endif>
                            <label>{{ $color->name }}</label>
                            <br>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="categories" value="{{ __('Category') }}" />
                        @foreach ($sizes as $size)
                            <input type="checkbox"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                name="sizes[]" value="{{ $size->id }}"
                                @if (in_array($size->id, $listing->sizes->pluck('id')->toArray())) checked @endif>
                            <label>{{ $size->name }}</label>
                            <br>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Edit listing') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
