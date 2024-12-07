@props(["subjects", "filters"])

@php
    use App\Http\Controllers\CategoryController;
@endphp


<div id = "filters" class="filters-container">
    <h3>Genres:</h3>

    <div class="genre-filters">
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
    </div>
</div>
