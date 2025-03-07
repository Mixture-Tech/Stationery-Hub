@props(['id', 'name', 'label', 'type' => 'text'])

<div class="mb-4">
    <label for="{{ $id }}" class="block text-navy-blue font-medium">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" 
           class="w-full p-3 border border-light-blue rounded-lg focus:outline-none focus:ring-2 focus:ring-medium-blue" 
           required>
</div>
