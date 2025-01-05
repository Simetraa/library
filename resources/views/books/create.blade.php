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

            @error('autofill')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </form>

        @php
            $title = session('title') ?? old('title');
            $author = session('author') ?? old('author');
            $coverUrl = session('cover_url') ?? old('cover_url');
            $description = session('description') ?? old('description');
            $publicationDate = session('publication_date') ?? old('publication_date');
            $isbn = session('isbn') ?? old('isbn');
            $subjects = session('subjects') ?? old('subjects');
        @endphp

        <form method="POST" action="/books" autocomplete="off">
            @csrf
            <div class = "book-input-field">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{$title}}">
                @error('title')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class = "book-input-field">
                <label for="author">Author</label>
                <input type="text" name="author" value="{{$author}}">
                @error('author')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class = "book-input-field">
                <label for="cover_url">Cover</label>
                <input type="text" name="cover_url" value="{{$coverUrl}}">
                @error('cover_url')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class = "book-input-field">
                <label for="description">Description</label>
                <input type="text" name="description" value="{{$description}}">
                @error('description')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class = "book-input-field">
                <label for="price">Price</label>
                <input type="number" min="0.01" step="0.01" name="price">
                @error('price')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="book-input-field">
                <label for="isbn">ISBN</label>
                <input type="number" name="isbn" value="{{$isbn}}">
                @error('isbn')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="book-input-field">
                <label for="subjects">Subjects</label>
                <input type="text" name="subjects" value="{{$subjects}}">
                @error('subjects')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="book-input-field">
                <label for="publication_date">Publication Date</label>
                <input type="date" name="publication_date" value="{{$publicationDate}}">
                @error('publication_date')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="button-p" id="edit-create-button">Submit</button>
        </form>
    </div>
</div>
</form>
</body>

</html>
