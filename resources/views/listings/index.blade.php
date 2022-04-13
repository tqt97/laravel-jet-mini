<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Listings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('message'))
                <div class="bg-green-500 py-2 px-6 text-white rounded-lg mb-4">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
            <div class="bg-red-500 py-2 px-6 text-white rounded-lg mb-4">
                {{ session('message') }}
            </div>
        @endif
            <a href="{{ route('listings.create') }}">
                <x-jet-button class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ __('Create Listing') }}
                </x-jet-button>
            </a>
            <div class="mb-4">
                <form method="GET" action="">
                    <input type="text" name="title" placeholder="Title" value="{{ request('title') }}" />
                    <select name="category">
                        <option value="">-- choose category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (request('category') == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="size">
                        <option value="">-- choose size --</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}" @if (request('size') == $size->id) selected @endif>
                                {{ $size->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="color">
                        <option value="">-- choose color --</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}" @if (request('color') == $color->id) selected @endif>
                                {{ $color->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="city">
                        <option value="">-- choose city --</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if (request('city') == $city->id) selected @endif>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @livewire('listing-saved-checkbox')
                    <button type="submit"
                        class="mb-4 inline-flex items-center px-2 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Search
                    </button>
                </form>
            </div>
            <div class="bg-white overflow-hidden1 shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 rounded">
                    <thead class="bg-slate-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-md font-bold text-slate-50 uppercase tracking-wider">
                            </th>
                            <th class="px-6 py-3 text-left text-md font-bold text-slate-50 uppercase tracking-wider">
                                Title
                            </th>
                            <th class="px-6 py-3 text-left text-md font-bold text-slate-50 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left text-md font-bold text-slate-50 uppercase tracking-wider">
                                Categories
                            </th>
                            <th class="px-6 py-3 text-left text-md font-bold text-slate-50 uppercase tracking-wider">
                                Sizes
                            </th>
                            <th class="px-6 py-3 text-left text-md font-bold text-slate-50 uppercase tracking-wider">
                                Colors
                            </th>
                            <th class="px-6 py-3 text-left text-md font-bold text-slate-50 uppercase tracking-wider">
                                City
                            </th>
                            <th class="px-6 py-3 text-left text-md font-bold text-slate-50 uppercase tracking-wider">
                                Price
                            </th>
                            <th class="relative px-6 py-3" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($listings as $listing)
                            <tr class="hover:bg-slate-50">
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <img src="{{ $listing->getFirstMediaUrl('listings', 'thumb') }}"
                                        class="rounded-full w-1/2 h-1/2" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $listing->title }}
                                    <br />
                                    <a href="{{ route('messages.create') }}?listing_id={{ $listing->id }}"
                                        class="underline">Send a message
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    {!! Str::words($listing->description, 10) !!}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($listing->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 ">
                                    @foreach ($listing->sizes as $size)
                                        {{ $size->name }}
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 ">
                                    @foreach ($listing->colors as $color)
                                        {{ $color->name }}
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $listing->user->city->name ?? '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">${{ $listing->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($listing->user_id != auth()->id())
                                        @livewire('listing-save-button', ['listingId' => $listing->id])
                                    @endif

                                    @can('update', $listing)
                                        <a href="{{ route('listings.edit', $listing) }}">
                                            <x-jet-button>
                                                Edit
                                            </x-jet-button>
                                        </a>
                                    @endcan
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @can('delete', $listing)
                                        <form method="POST" action="{{ route('listings.destroy', $listing) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-jet-danger-button>
                                                Delete
                                            </x-jet-danger-button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mx-6 my-4">
                    {{ $listings->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
