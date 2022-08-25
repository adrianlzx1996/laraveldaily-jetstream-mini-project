<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Send a Message') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
			<form action="{{ route('messages.store') }}" method="post">
				@csrf

				<input type="hidden" name="listing_id" value="{{ request('listing_id') }}"/>
				
				<div class="mt-4">
					<x-jet-label for="description" value="{{ __('Message') }}"/>
					<textarea name="message" id="message" cols="30" rows="5"
					          class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
					>{{ old('message') }}</textarea>
					<x-jet-input-error for="message"/>
				</div>

				<div class="flex items-center mt-6">
					<x-jet-button class="">
						{{ __('Send Message') }}
					</x-jet-button>
				</div>
			</form>
		</div>
	</div>
</x-app-layout>
