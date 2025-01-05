@props(["branch"])

<div class="dashboard-sidebar">
    <div class="dashboard-branch-info">
        <p>Branch: <x-branches-dropdown :current-branch="$branch"></x-branches-dropdown></p>
        <p>Branch Id: {{ $branch->id }}</p>
    </div>

    <div class="dashboard-sidebar-links">
        <a href="/branches/{{$branch->id}}/">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
        </a>
        <a href="/branches/{{$branch->id}}/inventory">
            <span class="material-symbols-outlined">book</span>
            <span>Inventory</span>
        </a>
        <a href="/branches/{{$branch->id}}/reservations">
            <span class="material-symbols-outlined">confirmation_number</span>
            <span>Reservations</span></a>
        <a href="/branches/{{$branch->id}}/sales">
            <span class="material-symbols-outlined">payments</span>
            <span>Sales</span>
        </a>
        <a href="/branches/{{$branch->id}}/purchases">
            <span class="material-symbols-outlined">payments</span>
            <span>Purchases</span>
        </a>
        @can('access-admin-pages')
            <a href="/branches/{{$branch->id}}/edit">
                <span class="material-symbols-outlined">edit</span>
                <span>Edit branch</span>
            </a>
            <a href="/branches/{{$branch->id}}/staff">
                <span class="material-symbols-outlined">store</span>
                <span>Staff</span>
            </a>
        @endcan
    </div>
</div>
