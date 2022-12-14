<x-guest-layout>
	<x-jet-authentication-card>
		<x-slot name="logo">
			<x-jet-authentication-card-logo/>
		</x-slot>

		<x-jet-validation-errors class="mb-4"/>

		<form method="POST" action="{{ route('register-step2.post') }}" enctype="multipart/form-data">
			@csrf

			<div>
				<x-jet-label for="phone" value="{{ __('Phone') }}"/>
				<x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"/>
			</div>

			<div class="mt-4">
				<x-jet-label for="address" value="{{ __('Address') }}"/>
				<x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"/>
			</div>

			<div class="mt-4">
				<x-jet-label for="city_id" value="{{ __('City') }}"/>
				<select name="city_id" id="city_id"
				        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
					@foreach($cities as $city)
						<option value="{{ $city->id }}">{{ $city->name }}</option>
					@endforeach
				</select>
			</div>

			<div class="mt-4">
				<x-jet-label for="photo" value="{{ __('Profile Photo') }}"/>
				<x-jet-input id="photo" class="block mt-1 w-full" type="file" name="photo" :value="old('photo')"/>
			</div>

			<div class="flex items-center justify-end mt-4">
				<x-jet-button class="ml-4">
					{{ __('Finish Register') }}
				</x-jet-button>
			</div>
		</form>
	</x-jet-authentication-card>
</x-guest-layout>
