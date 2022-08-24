<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Add New Listing') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<form action="{{ route('listings.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div>
					<x-jet-label for="title" value="{{ __('Title') }}"/>
					<x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"/>
					<x-jet-input-error for="title"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="description" value="{{ __('Description') }}"/>
					<textarea name="description" id="description" cols="30" rows="5"
					          class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
					>{{ old('description') }}</textarea>
					<x-jet-input-error for="description"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="price" value="{{ __('Price') }}"/>
					<x-jet-input id="price" class="block mt-1 w-full" type="text" name="price"
					             :value="old('price')"/>
					<x-jet-input-error for="price"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="photo1" value="{{ __('Photo 1') }}"/>
					<input type="file" id="photo1" name="photo1"/>
					<x-jet-input-error for="photo1"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="photo2" value="{{ __('Photo 2') }}"/>
					<input type="file" id="photo2" name="photo2"/>
					<x-jet-input-error for="photo2"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="photo3" value="{{ __('Photo 3') }}"/>
					<input type="file" id="photo3" name="photo3"/>
					<x-jet-input-error for="photo3"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="categories" value="{{ __('Categories') }}"/>
					<div class="space-y-2">
						@foreach($categories as $category)
							<div class="relative flex items-start">
								<div class="flex items-center h-5">
									<input id="{{ $category->name }}" name="categories[]"
									       type="checkbox"
									       value="{{ $category->id }}"
									       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
								</div>
								<div class="ml-3 text-sm">
									<label for="{{ $category->name }}"
									       class="font-medium text-gray-700">{{ $category->name }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<x-jet-input-error for="categories"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="colors" value="{{ __('Colors') }}"/>
					<div class="space-y-2">
						@foreach($colors as $color)
							<div class="relative flex items-start">
								<div class="flex items-center h-5">
									<input id="{{ $color->name }}" name="colors[]"
									       type="checkbox"
									       value="{{ $color->id }}"
									       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
								</div>
								<div class="ml-3 text-sm">
									<label for="{{ $color->name }}"
									       class="font-medium text-gray-700">{{ $color->name }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<x-jet-input-error for="colors"/>
				</div>

				<div class="mt-4">
					<x-jet-label for="sizes" value="{{ __('Sizes') }}"/>
					<div class="space-y-2">
						@foreach($sizes as $size)
							<div class="relative flex items-start">
								<div class="flex items-center h-5">
									<input id="{{ $size->name }}" name="sizes[]"
									       type="checkbox"
									       value="{{ $size->id }}"
									       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
								</div>
								<div class="ml-3 text-sm">
									<label for="{{ $size->name }}"
									       class="font-medium text-gray-700">{{ $size->name }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<x-jet-input-error for="sizes"/>
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
