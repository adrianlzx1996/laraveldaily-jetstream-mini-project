<?php

	namespace App\Http\Controllers;

	use App\Models\Message;
	use Illuminate\Http\Request;

	class MessageController extends Controller
	{

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function store ( Request $request )
		{
			$request->validate([ 'message' => [ 'required' ] ]);

			$sentMessage = Message::where('user_id', auth()->id())
								  ->where('created_at', '>', now()->subMinute())
								  ->count()
			;

			if ( $sentMessage < 5 ) {
				Message::create([
									'user_id'    => auth()->user()->id,
									'listing_id' => $request->listing_id,
									'message'    => $request->message,
								]);
			}

			return redirect()->route('listings.index')->with('message', 'Message sent successfully.');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function create ()
		{
			return view('messages.create');
		}

	}
