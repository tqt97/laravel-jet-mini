<span class="mx-2">
    <input @if (request('saved')) checked @endif type="checkbox" name="saved"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
    Save ({{ $saveAmount }})
</span>
