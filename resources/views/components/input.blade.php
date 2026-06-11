@props(['disabled' => false, 'type' => 'text', 'placeholder' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500']) !!} type="{{ $type }}" placeholder="{{ $placeholder }}">