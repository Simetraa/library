@props(["name", "options", "value", "autosubmit"])

@php
    $value = $value ?? "";
    $autosubmit = $autosubmit ?? false;
@endphp
{{-- we should work out how to access name from attributes instead. --}}
<select {{ $attributes }} name="{{ $name }}" {{ $autosubmit ? "onchange=this.form.submit()" : "" }}>
    @foreach($options as $option)
        <option
                value="{{ $option[1] }}"
                {{ $option[1] == $value ? "selected" : "" }}>{{ $option[0] }}</option>
    @endforeach
</select>

