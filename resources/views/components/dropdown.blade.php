@props(["name", "options", "value"])

@php
    $value = $value ?? "";
@endphp
{{-- we should work out how to access name from attributes instead. --}}
<select {{ $attributes }} name="{{ $name }}">
    @foreach($options as $option)
        <option value="{{ $option[1] }}" {{ $option[1] == $value ? "selected" : "" }}>{{ $option[0] }}</option>
    @endforeach
</select>

