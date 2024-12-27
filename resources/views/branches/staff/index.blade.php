@php use App\Models\Book; @endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>

@php
    $staffMembers = $branch->users->where('role', 'staff');
@endphp

<div class="sidebar-body">
    {{-- side bar --}}
    <x-dashboard-sidebar :branch="$branch"></x-dashboard-sidebar>
    <div>
        <h1>{{$branch->name}} - Staff</h1>
        <div class="inventory-inputs">
            <input type="text" placeholder="Filter inventory...">
        </div>
        <div class="inventory-panes">
            <div class="inventory-book-pane">
                <table class="inventory-table">
                    <thead>
                    <th scope="col">Staff ID</th>
                    <th scope="col">Email</th>
                    </thead>
                    <tbody>
                    @foreach($staffMembers as $staff)
                        <tr>
                            <td>{{ $staff->id }}</td>
                            <td>{{ $staff->email }}</td>
                            <td>
                                <a href="/branches/{{$branch->id}}/staff/{{$staff->id}}/edit">edit</a>
                            </td>
                            <td>
                                <form action="/branches/{{$branch->id}}/staff/{{$staff->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><span class="material-symbols-outlined">delete</span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>
