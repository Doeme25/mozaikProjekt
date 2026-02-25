<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Mozaik Projekt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        nav {
            background-color: #1a1a2e;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .logo {
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.5rem;
            color: #1a1a2e;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .book-detail {
            background: #fff;
            border-radius: 10px;
            padding: 2.5rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        }

        .book-detail h1 {
            font-size: 2rem;
            margin-bottom: 0.25rem;
            color: #1a1a2e;
        }

        .book-detail .author {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        .book-detail .divider {
            border: none;
            border-top: 1px solid #eee;
            margin: 1.5rem 0;
        }

        .book-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .info-item {
            background: #f9f9f9;
            padding: 1rem 1.25rem;
            border-radius: 8px;
        }

        .info-item .label {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .info-item .value {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        .book-description {
            margin-top: 1.5rem;
            line-height: 1.7;
            color: #555;
        }

        .book-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1.25rem;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-edit {
            background-color: #1a1a2e;
            color: #fff;
        }

        .btn-edit:hover {
            background-color: #16213e;
        }

        .btn-save {
            background-color: #28a745;
            color: #fff;
        }

        .btn-save:hover {
            background-color: #218838;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #a71d2a;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
        }

        /* Edit mode inputs */
        .edit-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            background: #fff;
        }

        .edit-input:focus {
            outline: none;
            border-color: #1a1a2e;
        }

        .edit-input-title {
            font-size: 1.75rem;
            font-weight: bold;
        }

        .edit-input-author {
            font-size: 1rem;
            color: #666;
        }

        .view-mode { display: block; }
        .edit-mode { display: none; }

        .editing .view-mode { display: none; }
        .editing .edit-mode { display: block; }
        .editing .book-info .view-mode { display: none; }
        .editing .book-info .edit-mode { display: block; }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 0.75rem 1.25rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <nav>
        <a href="/" class="logo">Mozaik Projekt</a>
    </nav>

    <div class="container">
        <a href="/" class="back-link">&larr; Back to all books</a>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <div class="book-detail" id="bookDetail">
            <form method="POST" action="/books/{{ $book->id }}" id="editForm">
                @csrf
                @method('PUT')

                <div class="book-header">
                    <div style="flex: 1;">
                        <h1 class="view-mode">{{ $book->title }}</h1>
                        <input type="text" name="title" value="{{ $book->title }}" class="edit-mode edit-input edit-input-title">

                        <p class="author view-mode">by {{ $book->author }}</p>
                        <input type="text" name="author" value="{{ $book->author }}" class="edit-mode edit-input edit-input-author" style="margin-top: 0.5rem;">
                    </div>

                    <div>
                        <button type="button" class="btn btn-edit view-mode" onclick="toggleEdit()">Edit</button>
                        <div class="btn-group edit-mode">
                            <button type="submit" class="btn btn-save">Save</button>
                            <button type="button" class="btn btn-cancel" onclick="toggleEdit()">Cancel</button>
                        </div>
                    </div>
                </div>

                <hr class="divider">

                <div class="book-info">
                    <div class="info-item">
                        <div class="label">Published Year</div>
                        <div class="value view-mode">{{ $book->published_year }}</div>
                        <input type="number" name="published_year" value="{{ $book->published_year }}" class="edit-mode edit-input">
                    </div>
                    <div class="info-item">
                        <div class="label">Units Sold</div>
                        <div class="value view-mode">{{ $book->units_sold }}</div>
                        <input type="number" name="units_sold" value="{{ $book->units_sold }}" class="edit-mode edit-input">
                    </div>
                    <div class="info-item">
                        <div class="label">Remaining Stock</div>
                        <div class="value view-mode">{{ $book->remaining_stock }}</div>
                        <input type="number" name="remaining_stock" value="{{ $book->remaining_stock }}" class="edit-mode edit-input">
                    </div>
                </div>

                <hr class="divider">

                <div class="label" style="margin-bottom: 0.5rem;">Description</div>
                <p class="book-description view-mode">{{ $book->description ?? 'No description' }}</p>
                <textarea name="description" class="edit-mode edit-input" rows="4" style="resize: vertical;">{{ $book->description }}</textarea>
            </form>

            <div>
                @if($book->cover_image)
                    <img src="/uploads/{{ $book->cover_image }}" alt="Cover Image" style="max-width: 200px; margin-top: 1rem; border-radius: 6px;">
                @else
                    <p style="margin-top: 1rem; color: #999;">No cover image uploaded.</p>
                @endif
        </div>
        <div>
            <form action="/books/{{ $book->id }}/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" required>
                <button type="submit" class="upload-image-btn"> Upload Image</button>
            </form> 
        </div>

        <div style="margin-top: 1.5rem;">
            <form action="/books/{{ $book->id }}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Delete Book</button>
            </form>
        </div>
    </div>

    <script>
        function toggleEdit() {
            document.getElementById('bookDetail').classList.toggle('editing');
        }
    </script>

</body>
</html>