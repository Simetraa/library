<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}"/>
</head>

<body class="non-gradient-body">
<x-header></x-header>

<div class = "container-centre">
    <div class="book-cover">
        <img src="{{ $book["cover_url"] }}" alt="book cover">
    </div>
    <div class='bg-white-container' id="book-container">

        <h1>Edit book</h1>
            <form method="POST" action="/books/{{$book["id"]}}" autocomplete="off">
                @csrf
                @method("PATCH")

                <div class = "book-input-field">
                    <label for="id">Id</label>
                    <input readonly value="{{ $book["id"] }}" type="text" name="id" disabled>
                </div>
                <div class = "book-input-field">
                    <label for="title">Title:</label>
                    <input value="{{ $book["title"] }}" type="text" name="title">
                    @error('title')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class = "book-input-field">
                    <label for="author">Author:</label>
                    <input value="{{ $book["author"] }}" type="text" name="author">
                    @error('author')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class = "book-input-field">
                    <label for="cover_url">Cover:</label>
                    <input value="{{ $book["cover_url"] }}" type="text" name="cover_url">
                    @error('cover_url')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class = "book-input-field">
                    <label for="description">Description:</label>
                    <input value="{{ $book["description"] }}" type="text" name="description">
                    @error('description')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class = "book-input-field">
                    <label for="price">Price (£):</label>
                    <input value="{{ $book->price }}" type="number" min="0.01" step="0.01" name="price">
                    @error('price')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="book-input-field">
                    <label for="isbn">ISBN</label>
                    <input value="{{ $book->isbn }}" type="number" name="isbn">
                    @error('isbn')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="book-input-field">
                    <label for="subjects">Subjects</label>
                    <input type="text" name="subjects" value="{{join(",",$book->subjects)}}">
                    @error('subjects')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="book-input-field">
                    <label for="publication_date">Publication Date</label>
                    <input type="date" name="publication_date" value="{{$book->publication_date}}">
                    @error('publication_date')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <button class="button-p" id="edit-create-button">Submit</button>
        </form>
    </div>
</div>
</body>

</html>
