<?php

	namespace App\Http\Controllers;

	use App\Http\Requests\StoreListingRequest;
	use App\Http\Requests\UpdateListingRequest;
	use App\Models\Listing;
	use Illuminate\Http\RedirectResponse;

	class ListingController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index ()
		{
			$listings = Listing::all();

			return view('listings.index', compact('listings'));
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \App\Http\Requests\StoreListingRequest $request
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function store ( StoreListingRequest $request )
		: RedirectResponse {
			Listing::create($request->validated());

			return redirect()->route('listings.index')->with('success', 'Listing created successfully.');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function create ()
		{
			return view('listings.create');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param \App\Models\Listing $listing
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show ( Listing $listing )
		{
			//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param \App\Models\Listing $listing
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function edit ( Listing $listing )
		{
			return view('listings.edit', compact('listing'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \App\Http\Requests\UpdateListingRequest $request
		 * @param \App\Models\Listing                     $listing
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function update ( UpdateListingRequest $request, Listing $listing )
		: RedirectResponse {
			$listing->update($request->validated());

			return redirect()->route('listings.index')->with('success', 'Listing updated successfully.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param \App\Models\Listing $listing
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function destroy ( Listing $listing )
		{
			$listing->delete();

			return redirect()->route('listings.index')->with('success', 'Listing deleted successfully.');
		}
	}
