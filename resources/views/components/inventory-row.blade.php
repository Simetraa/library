@props(["book"])
<tr>
    <td>{{ $book["id"] }}</td>
    <td>{{ $book["title"] }}</td>
    <td>{{ $book["author"] }}</td>
    <td>{{ $book["cover_url"] }}</td>
    <td class="paragraph-truncate">{{ $book["description"] }}</td>
    <td>{{ $book->getPrice()}}</td>
    <td>
        <a id="edit_button" href="/books/{{$book["id"]}}/edit">
            <span class="material-symbols-outlined">edit</span>
        </a>
    </td>
    <td>
        <form method="POST" action="/books/{{$book["id"]}}/toggleVisibility">
            @csrf
            @method("PATCH")
            <button class="icon" type="submit">
                <span class="material-symbols-outlined">{{$book->visible ? "visibility" : "visibility_off"}}</span>
            </button>
        </form>
    </td>
</tr>
