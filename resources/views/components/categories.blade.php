@props(["subjects", "filters"])

@php
    use App\Http\Controllers\CategoryController;
@endphp


<div id = "filters" class="filters-container">
    <div class="filter-container-header">
        <h3>Genres:</h3>
        <button onclick="hideshowfilters()" class = "filter-close">&#10006</button>
    </div>

    <form class="genre-filter-form" action="/">
        @foreach($subjects as $subjectName => $subject)
            <div>
                @foreach($subject as $category)
                    @if($loop->first)
                        <input name="genre[]" value="{{ $loop->parent->iteration . "," . $loop->iteration }}" {{ in_array($loop->parent->iteration . "," . $loop->iteration, $filters) ? "checked" : ""}} type="checkbox">
                        <label for="genre[]">{{ $subjectName }}</label>
                    @endif
                    <div style="margin-left: 30px   ">
                        <input name="genre[]" value="{{ $loop->parent->iteration . "," . $loop->iteration + 1}}" {{ in_array($loop->parent->iteration . "," . $loop->iteration + 1, $filters) ? "checked" : "" }} type="checkbox">
                        <label for="genre[]">{{ $category }}</label>
                    </div>
              @endforeach
            </div>
        @endforeach
    </form>
</div>
