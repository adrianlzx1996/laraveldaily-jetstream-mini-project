<?php

	namespace App\Http\Controllers;

	use App\Http\Requests\StoreListingRequest;
	use App\Http\Requests\UpdateListingRequest;
	use App\Models\Category;
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
			$listings = Listing::with('categories')->get();

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
			$listing = auth()->user()->listings()->create($request->validated());

			for ( $i = 1; $i <= 3; $i++ ) {
				if ( $request->hasFile('photo' . $i) ) {
					$listing->addMediaFromRequest('photo' . $i)->toMediaCollection('listings');
				}
			}

			$listing->categories()->attach($request->categories);

			return redirect()->route('listings.index')->with('success', 'Listing created successfully.');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function create ()
		{
			$categories = Category::all();

			return view('listings.create', compact('categories'));
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
			$this->authorize('update', $listing);

			$listing->load('categories');

			$media      = $listing->getMedia('listings');
			$categories = Category::all();

			return view('listings.edit', compact('listing', 'media', 'categories'));
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
			$this->authorize('update', $listing);

			$listing->update($request->validated());

			for ( $i = 1; $i <= 3; $i++ ) {
				if ( $request->hasFile('photo' . $i) ) {
					$listing->addMediaFromRequest('photo' . $i)->toMediaCollection('listings');
				}
			}

			$listing->categories()->sync($request->categories);

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
			$this->authorize('delete', $listing);

			$listing->delete();

			return redirect()->route('listings.index')->with('success', 'Listing deleted successfully.');
		}

		public function deletePhoto ( $listingId, $photoId )
		: RedirectResponse {
			$listing = Listing::where('user_id', auth()->id())->findOrFail($listingId);

			$listing->getMedia('listings')->where('id', $photoId)->first()->delete();

			return redirect()->route('listings.edit', $listingId)->with('success', 'Photo deleted successfully.');
		}
	}
