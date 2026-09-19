@props(['name', 'value' => '', 'id' => null])

@php($id ??= 'trix-' . $name)

<input id="{{ $id }}_input" type="hidden" name="{{ $name }}" value="{{ old($name, $value) }}">
<trix-editor input="{{ $id }}_input"></trix-editor>
