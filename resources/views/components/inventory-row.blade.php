@props(["book"])
<tr>
    <td><input type="checkbox"></td>
    <td>{{ $book["id"] }}</td>
    <td>{{ $book["title"] }}</td>
    <td>{{ $book["author"] }}</td>
    <td>{{ $book["cover_url"] }}</td>
    <td class="paragraph-truncate">{{ $book["description"] }}</td>
    <td>{{ $book->getPrice()}}</td>
    <td>{{ $book["quantity"] }}</td>
</tr>
