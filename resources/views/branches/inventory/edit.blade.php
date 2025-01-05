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
<div class="container-centre">
    <div class="bg-white-container"  id="edit-inventory-item-container">


        @php
            use App\Models\Branch;

            $book = $branch->books->find($book->id);
        @endphp
        <h1>Edit Inventory Item</h1>
        <div class="account-info">
            <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}" class="edit-inventory-item-form">
                @csrf
                @method('PATCH')
                <div class="space-between">
                    <label for="quantity">Edit Quantity</label>
                    <input required type="number" min="0" name="quantity" value="{{$book->pivot->quantity}}" class="input" style="width: 50px">
                </div>
                <div class="space-between">
                    <label for="reason">Reason</label>
                    <select name="reason" required id="branch-selection-dropdown">
                        <option value="">Please select a reason</option>
                        <option value="theft">Theft</option>
                        <option value="damage">Damage</option>
                        <option value="lost">Lost</option>
                    </select>
                </div>


                @error('quantity')
                <p class="form-error">{{ $message }}</p>
                @enderror

                @error('reason')
                <p class="form-error">{{ $message }}</p>
                @enderror
                <button type="submit" class="button-p" id="profile-button">Submit</button>
            </form>
            <hr>
            <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}/transfer" class="edit-inventory-item-form">
                @csrf
                @method('POST')
                <div class="space-between">
                    <label for="quantity">Transfer Quantity</label>
                    <input required type="number" min="0" max="{{$book->pivot->quantity}}" name="quantity" value="{{$book->pivot->quantity}}" class="input" >
                </div>
                <div class="space-between">
                    <label for="branch">To</label>
                    <x-dropdown id="branch-selection-dropdown"
                                name="branch_id"
                                :options="Branch::getBranches()"
                                :value="$branch->id">
                    </x-dropdown>
                </div>

                @error('quantity')
                <p class="form-error">{{ $message }}</p>
                @enderror
                @error('branch_id')
                <p class="form-error">{{ $message }}</p>
                @enderror

                <button type="submit" class="button-p" id="profile-button">Transfer</button>
            </form>
        </div>
        <form method="POST" action="/branches/{{$branch->id}}/inventory/{{$book->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="button-r" id="delete-profile-button">Delete</button>
        </form>
        <br>
        <a href="/branches/{{$branch->id}}/inventory" class="back-link">Back to inventory</a>
    </div>
</div>
</body>

</html>
