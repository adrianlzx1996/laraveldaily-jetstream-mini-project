<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Listings') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				<table class="min-w-full divide-y divide-gray-300">
					<thead class="bg-gray-50">
					<tr>
						<th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
						<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
					</tr>
					</thead>
					<tbody class="divide-y divide-gray-200 bg-white">
					@foreach($listings as $listing)
						<tr>
							<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $listing->title }}</td>
							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $listing->description }}</td>
							<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $listing->price }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</x-app-layout>
