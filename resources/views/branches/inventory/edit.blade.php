<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Item</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div>

    @php
        use App\Models\Branch;

        $book = $branch->books->find($book->id);
    @endphp
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

    <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}/transfer">
        @csrf
        @method('POST')
        <div>
            <label for="quantity">Transfer Quantity</label>
            <input required type="number" min="0" name="quantity" value="{{$book->pivot->quantity}}">
        </div>

        <x-dropdown id="branch-selection-dropdown"
                    name="branch_id"
                    :options="Branch::getBranches()"
                    :value="$branch->id">
        </x-dropdown>


        @error('quantity')
        <p class="form-error">{{ $message }}</p>
        @enderror
        @error('branch_id')
        <p class="form-error">{{ $message }}</p>
        @enderror

        <button type="submit">Transfer</button>
    </form>

    <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="/branches/{{$branch->id}}/inventory">Back</a>
</div>
</body>

</html>
