@props(["name", "dropdownValues"])

<form {{ $attributes }}>
    <select name="{{ $name }}" onchange='this.form.submit()'>
        @foreach($dropdownValues as $value)
            <option value="{{ $value[1] }}" {{ $value[1] == request()->get($name) ? "selected" : "" }}>{{ $value[0] }}</option>
        @endforeach
    </select>
</form>
