<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Message;
use App\Notifications\ListingMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{

    public function create()
    {
        return view('messages.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|min:3',
        ]);

        $listing = Listing::with('user')->findOrFail($request->listing_id);

        $sentMessage = Message::where('user_id', auth()->id())->where('created_at', '>', now()->subMinute())->count();
        if ($sentMessage < 5) {
            Message::create([
                'user_id' => auth()->id(),
                'listing_id' => $request->listing_id,
                'message_text' => $request->message,
            ]);
            $message = [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'listingTitle' => $listing->title,
                'messageText' => $request->message,
            ];
            Notification::route('mail', $listing->user->email)
                ->notify(new ListingMessageNotification($message));
        }
        return redirect()->route('listings.index', $request->listing_id)->with('message', 'Message sent!');
    }
}
