<div class="relative flex items-start">
	<div class="flex items-center h-5">
		<input id="saved" name="saved"
		       type="checkbox"
		       @if (request('saved')) checked @endif
		       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
	</div>
	<div class="ml-3 text-sm">
		<label for="saved"
		       class="font-medium text-gray-700">Saved ({{ $savedAmount }})</label>
	</div>
</div>
