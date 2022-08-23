<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Edit Listing') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<form action="{{ route('listings.update', $listing) }}" method="post">
				@csrf
				@method('PUT')

				<div>
					<x-jet-label for="title" value="{{ __('Title') }}"/>
					<x-jet-input id="title" class="block mt-1 w-full" type="text" name="title"
					             :value="$listing->title"/>
					<x-jet-input-error for="title"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="description" value="{{ __('Description') }}"/>
					<textarea name="description" id="description" cols="30" rows="5"
					          class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
					>{{ $listing->description }}</textarea>
					<x-jet-input-error for="description"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="price" value="{{ __('Price') }}"/>
					<x-jet-input id="price" class="block mt-1 w-full" type="text" name="price"
					             :value="$listing->price"/>
					<x-jet-input-error for="price"/>
				</div>

				<div class="flex items-center mt-6">
					<x-jet-button class="">
						{{ __('Save Listing') }}
					</x-jet-button>
				</div>
			</form>
		</div>
	</div>
</x-app-layout>
