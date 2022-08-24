<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Listings') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<a class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
			   href="{{ route('listings.create') }}">{{ __("Add new Listing") }}</a>
			<div class="bg-white overflow-x-auto shadow-xl sm:rounded-lg">
				<table class="divide-y divide-gray-300">
					<thead class="bg-gray-50">
					<tr>
						<th class="px-6 py-6 text-left text-sm font-semibold text-gray-900"></th>
						<th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Categories</th>
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
							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $listing->description }}</td>
							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
								@foreach($listing->categories as $category)
									{{ $category->name }}
								@endforeach
							</td>
							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${{ $listing->price }}</td>
							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
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
		</div>
	</div>
</x-app-layout>
