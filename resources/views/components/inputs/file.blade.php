@props(['id', 'name', 'label' => null, 'required' => false, 'accept' => null])

<div class="mb-6">
  @if($label)
  <label class="block text-sm font-medium text-gray-900 mb-2" for="{{ $id }}">
    {{ $label }}
    @if($required)
      <span class="text-red-500">*</span>
    @endif
  </label>
  @endif
  <div class="relative">
    <input
      id="{{ $id }}"
      type="file"
      name="{{ $name }}"
      {{ $required ? 'required' : '' }}
      {{ $accept ? 'accept=' . $accept : '' }}
      class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error($name) !border-red-500 !ring-red-500 @enderror"
    />
  </div>
  @error($name)
  <div class="flex items-center mt-2">
    <svg class="w-4 h-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
    </svg>
    <p class="text-sm text-red-600">{{ $message }}</p>
  </div>
  @enderror
</div>