@props(["currentBranch"])
@php
    use App\Models\Branch;
@endphp

<x-dropdown id="branch-selection-dropdown"
            name="branch_id"
            :options="Branch::getBranches()"
            :value="$currentBranch->id">
</x-dropdown>

<script>
    let branchSelector = document.getElementById('branch-selection-dropdown');
    branchSelector.addEventListener('change', function () {
        let idSuffix = new URL(window.location.href).pathname.split("/").slice(3).join("")
        window.location.href = "/branches/" + branchSelector.value + "/" + idSuffix;
    });
</script>
