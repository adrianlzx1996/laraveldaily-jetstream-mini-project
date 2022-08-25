<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Listings') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
			<a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
			   href="{{ route('listings.create') }}">{{ __("Add new Listing") }}</a>

			<div class="">
				<form action="" method="get">
					<div class="grid sm:grid-cols-6 gap-2">
						<input
							class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
							type="text" name="title" id="title" placeholder="Search Title..."
							value="{{ request('title') }}"/>

						<select
							class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
							name="category" id="category">
							<option value="">- choose category -</option>
							@foreach($categories as $category)
								<option
									{{ request('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
							@endforeach
						</select>

						<select
							class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
							name="color" id="color">
							<option value="">- choose color -</option>
							@foreach($colors as $color)
								<option
									{{ request('color') == $color->id ? 'selected' : '' }} value="{{ $color->id }}">{{ $color->name }}</option>
							@endforeach
						</select>

						<select
							class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
							name="size" id="size">
							<option value="">- choose size -</option>
							@foreach($sizes as $size)
								<option
									{{ request('size') == $size->id ? 'selected' : '' }} value="{{ $size->id }}">{{ $size->name }}</option>
							@endforeach
						</select>

						<select
							class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
							name="city" id="city">
							<option value="">- choose city -</option>
							@foreach($cities as $city)
								<option value="{{ $city->id }}">{{ $city->name }}</option>
							@endforeach
						</select>

						<livewire:listing-save-checkbox/>

						<div>
							<button
								class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
							>{{ __("Search") }}</button>
						</div>
					</div>
				</form>
			</div>

			<div class="bg-white overflow-x-auto shadow-xl sm:rounded-lg">
				<table class="w-full divide-y divide-gray-300">
					<thead class="bg-gray-50">
					<tr>
						<th class="px-6 py-6 text-left text-sm font-semibold text-gray-900"></th>
						<th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Categories</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Colors</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sizes</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">City</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
						<th colspan="2" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
					</tr>
					</thead>
					<tbody class="divide-y divide-gray-200 bg-white">
					@foreach($listings as $listing)
						<tr>
							<td class="">
								@if ($listing->getFirstMediaUrl('listings','thumb'))
									<img class="w-10 h-10" src="{{ $listing->getFirstMediaUrl('listings','thumb') }}"
									     alt="{{ $listing->title }}">
								@endif
							</td>
							<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $listing->title }}</td>
							<td class="px-3 py-4 text-sm text-gray-500">{{ $listing->description }}</td>

							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
								@foreach($listing->categories as $category)
									{{ $category->name }}
								@endforeach
							</td>

							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
								@foreach($listing->colors as $color)
									{{ $color->name }}
								@endforeach
							</td>

							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
								@foreach($listing->sizes as $size)
									{{ $size->name }}
								@endforeach
							</td>

							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
								{{ $listing->user->city->name ?? '' }}
							</td>

							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${{ $listing->price }}</td>
							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
								@if($listing->user_id != auth()->user()->id)
									<livewire:listing-save-button :listing-id="$listing->id"/>
								@endif
								@can('update', $listing)
									<a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
									   href="{{ route('listings.edit', $listing) }}">Edit</a>
								@endcan
							</td>
							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
								@can('delete', $listing)
									<form action="{{ route('listings.destroy', $listing) }}" method="post">
										@csrf
										@method('DELETE')
										<x-jet-danger-button onclick="return confirm('Are you sure?')" type="submit">
											Delete
										</x-jet-danger-button>
									</form>
								@endcan
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>

			{{ $listings->links() }}
		</div>
	</div>
</x-app-layout>
