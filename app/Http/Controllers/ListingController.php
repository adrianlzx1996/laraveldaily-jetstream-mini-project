<?php

	namespace App\Http\Controllers;

	use App\Http\Requests\StoreListingRequest;
	use App\Http\Requests\UpdateListingRequest;
	use App\Models\Category;
	use App\Models\City;
	use App\Models\Color;
	use App\Models\Listing;
	use App\Models\Size;
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
			$listings = Listing::with([ 'categories', 'colors', 'sizes', 'user.city' ])
							   ->when(request('title'), function ( $query ) {
								   return $query->where('title', 'like', '%' . request('title') . '%');
							   })
							   ->when(request('category'), function ( $query ) {
								   return $query->whereHas('categories', function ( $query ) {
									   $query->where('category_id', request('category'));
								   });
							   })
							   ->when(request('size'), function ( $query ) {
								   return $query->whereHas('sizes', function ( $query ) {
									   $query->where('size_id', request('size'));
								   });
							   })
							   ->when(request('color'), function ( $query ) {
								   return $query->whereHas('colors', function ( $query ) {
									   $query->where('color_id', request('color'));
								   });
							   })
							   ->when(request('city'), function ( $query ) {
								   return $query->whereHas('user.city', function ( $query ) {
									   $query->where('id', request('city'));
								   });
							   })
							   ->when(request('saved'), function ( $query ) {
								   return $query->whereHas('savedUsers', function ( $query ) {
									   $query->where('id', auth()->user()->id);
								   });
							   })
							   ->paginate(5)
							   ->withQueryString()
			;

			$categories = Category::all()->sortBy('name');
			$colors     = Color::all()->sortBy('name');
			$cities     = City::all()->sortBy('name');
			$sizes      = Size::all();

			return view('listings.index', compact('listings', 'categories', 'cities', 'colors', 'sizes'));
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
			$listing->colors()->attach($request->colors);
			$listing->sizes()->attach($request->sizes);

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
			$colors     = Color::all();
			$sizes      = Size::all();

			return view('listings.create', compact('categories', 'colors', 'sizes'));
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

			$listing->load([ 'categories', 'colors', 'sizes' ]);

			$media      = $listing->getMedia('listings');
			$categories = Category::all();
			$colors     = Color::all();
			$sizes      = Size::all();

			return view('listings.edit', compact('listing', 'media', 'categories', 'colors', 'sizes'));
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
			$listing->colors()->sync($request->colors);
			$listing->sizes()->sync($request->sizes);

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
