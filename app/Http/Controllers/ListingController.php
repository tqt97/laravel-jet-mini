<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\Size;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::with('categories', 'sizes', 'colors', 'user.city')
            ->when(request('title'), function ($query) {
                $query->where('title', 'LIKE', '%' . request('title') . '%');
            })
            ->when(request('category'), function ($query) {
                $query->whereHas('categories', function ($query2) {
                    $query2->where('id', request('category'));
                });
            })
            ->when(request('size'), function ($query) {
                $query->whereHas('sizes', function ($query2) {
                    $query2->where('id', request('size'));
                });
            })
            ->when(request('color'), function ($query) {
                $query->whereHas('colors', function ($query2) {
                    $query2->where('id', request('color'));
                });
            })
            ->when(request('saved'), function ($query) {
                $query->whereHas('savedUsers', function ($query2) {
                    $query2->where('id', auth()->id());
                });
            })
            ->latest()->paginate(10)->withQueryString();
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        $cities = City::all();

        return view('listings.index', compact('listings', 'categories', 'sizes', 'colors', 'cities'));
    }

    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('listings.create', compact('categories', 'sizes', 'colors'));
    }

    public function store(StoreListingRequest $request)
    {
        $listing = auth()->user()->listings()->create($request->validated());
        // $listing = Listing::create($request->validated()  + ['user_id' => auth()->id()]);

        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasFile('photo' . $i)) {
                $listing->addMediaFromRequest('photo' . $i)->toMediaCollection('listings');
            }
        }

        $listing->categories()->attach($request->categories);
        $listing->sizes()->attach($request->sizes);
        $listing->colors()->attach($request->colors);

        return redirect()->route('listings.index');
    }

    public function show(Listing $listing)
    {
        //
    }

    public function edit(Listing $listing)
    {
        $this->authorize('update', $listing);

        $listing->load('categories', 'sizes', 'colors');

        $media = $listing->getMedia('listings');

        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();

        return view('listings.edit', compact('listing', 'media', 'categories', 'sizes', 'colors'));
    }

    public function update(UpdateListingRequest $request, Listing $listing)
    {
        $this->authorize('update', $listing);

        $listing->update($request->validated());

        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasFile('photo' . $i)) {
                $listing->addMediaFromRequest('photo' . $i)->toMediaCollection('listings');
            }
        }
        $listing->categories()->sync($request->categories);
        $listing->sizes()->sync($request->sizes);
        $listing->colors()->sync($request->colors);

        return redirect()->route('listings.index');
    }

    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->delete();

        return redirect()->route('listings.index');
    }
    public function deletePhoto($listingId, $photoId)
    {
        $listing = Listing::where('user_id', auth()->id())->findOrFail($listingId);

        $photo = $listing->getMedia('listings')->where('id', $photoId)->first();

        if ($photo) {
            $photo->delete();
        }

        return redirect()->route('listings.edit', $listingId);
    }
}
