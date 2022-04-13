<span>

    @if($savedListing)
    <a href="#" wire:click.prevent="unSaveListing">
        <x-jet-button>
            Unsave
        </x-jet-button>
    </a>
    @else
    <a href="#" wire:click.prevent="saveListing">
        <x-jet-button>
            Save
        </x-jet-button>
    </a>
    @endif
</span>
