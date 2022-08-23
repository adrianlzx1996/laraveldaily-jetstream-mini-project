<?php

	namespace App\Http\Controllers;

	use App\Http\Requests\StoreListingRequest;
	use App\Http\Requests\UpdateListingRequest;
	use App\Models\Listing;

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
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create ()
		{
			//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \App\Http\Requests\StoreListingRequest $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store ( StoreListingRequest $request )
		{
			//
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
		 * @return \Illuminate\Http\Response
		 */
		public function edit ( Listing $listing )
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \App\Http\Requests\UpdateListingRequest $request
		 * @param \App\Models\Listing                     $listing
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update ( UpdateListingRequest $request, Listing $listing )
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param \App\Models\Listing $listing
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy ( Listing $listing )
		{
			//
		}
	}
