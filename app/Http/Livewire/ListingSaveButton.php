<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ListingSaveButton extends Component
{
    public $listingId;

    public function saveListing()
    {
        auth()->user()->savedListings()->attach($this->listingId);
        $this->emit('listingSaved');
    }
    public function unSaveListing()
    {
        auth()->user()->savedListings()->detach($this->listingId);
        $this->emit('listingSaved');
    }

    public function render()
    {
        $savedListing = auth()->user()->savedListings()->get()->contains($this->listingId);
        return view('livewire.listing-save-button',compact('savedListing'));
    }
}
