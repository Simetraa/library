<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div>

{{--    @php--}}
{{--        $book = $branch->books->find($book->id);--}}
{{--    @endphp--}}
    <h1>Edit Inventory Item</h1>
    <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}">
        @csrf
        @method('PATCH')
        <div>
            <label for="quantity">Quantity</label>
            <input required type="number" min="0" name="quantity" value="{{$book->pivot->quantity}}">
        </div>

        <select name="reason" required>
            <option value="">Please select a reason</option>
            <option value="theft">Theft</option>
            <option value="damage">Damage</option>
            <option value="lost">Lost</option>
        </select>

        @error('quantity')
        <p class="form-error">{{ $message }}</p>
        @enderror

        @error('reason')
        <p class="form-error">{{ $message }}</p>
        @enderror
        <button type="submit">Submit</button>
    </form>

{{--    transfer   --}}
    <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}">
        @csrf
        @method('PATCH')
        <div>
            <label for="quantity">Transfer Quantity</label>
            <input required type="number" min="0" name="quantity" value="{{$book->pivot->quantity}}">
        </div>

        <x-branches-dropdown name="branch_id" :options="$branches" :value="$currentBranch"></x-branches-dropdown>

        @error('quantity')
        <p class="form-error

    <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="/branches/{{$branch->id}}/inventory">Back</a>
</div>
</body>

</html>
