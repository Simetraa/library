@props(["book"])
<tr>
    <td><input type="checkbox"></td>
    <td>{{ $book["id"] }}</td>
    <td>{{ $book["title"] }}</td>
    <td>{{ $book["author"] }}</td>
    <td>{{ $book["cover_url"] }}</td>
    <td class="paragraph-truncate">{{ $book["description"] }}</td>
    <td>{{ $book->getPrice()}}</td>
    <td class="text-right">{{ $book["quantity"] }}</td>
    <td>
        <a id="edit_button" href="/books/{{$book["id"]}}/edit">
            <span class="material-symbols-outlined">edit</span>
        </a>
    </td>
    <td>
        <form method="POST" action="/books/{{$book["id"]}}">
            @csrf
            @method('DELETE')
            <button type="submit" id="delete_button">
                <span class="material-symbols-outlined">delete</span>
            </button>
        </form>
    </td>
{{--    <td><button id="visibility_button">visibility</button></td>--}}
</tr>
