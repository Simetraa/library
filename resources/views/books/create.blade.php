<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create book</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>
<div class="container-centre">
    <div class="book-container">
        <h1>Create book</h1>
        <form method="POST" action="/books/autofill">
            @csrf
            <label for="title">ISBN:</label>
            <input name="isbn">
            <button type="submit" class="button-p">Autofill Form</button>
        </form>

        @php
            $title = session('title');
            $author = session('author');
            $coverUrl = session('cover_url');
            $description = session('description');
            $publicationDate = session('publication_date');
            $isbn = session('isbn');
            $subjects = session('subjects');
//            dd(session()->all());
        @endphp

        <form method="POST" action="/books" autocomplete="off">
            @csrf
            <div class = "book-input-field">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{$title}}">
            </div>
            <div class = "book-input-field">
                <label for="author">Author</label>
                <input type="text" name="author" value="{{$author}}">
            </div>

            <div class = "book-input-field">
                <label for="cover_url">Cover</label>
                <input type="text" name="cover_url" value="{{$coverUrl}}">
            </div>
            <div class = "book-input-field">
                <label for="description">Description</label>
                <input type="text" name="description" value="{{$description}}">
            </div>
            <div class = "book-input-field">
                <label for="price">Price</label>
                <input type="number" min="0.01" step="0.01" name="price">
            </div>
            <div class="book-input-field">
                <label for="isbn">ISBN</label>
                <input type="number" name="isbn" value="{{$isbn}}">
            </div>

            <div class="book-input-field">
                <label for="subjects">Subjects</label>
                <input type="text" name="subjects" value="{{$subjects}}">
            </div>

            <div class="book-input-field">
                <label for="publication-date">Publication Date</label>
                <input type="date" name="publication-date" value="{{$publicationDate}}">
            </div>

            <button type="submit" class="button-p" id="edit-create-button">Submit</button>
        </form>
    </div>
</div>
</form>
</body>

</html>
