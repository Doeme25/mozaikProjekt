<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book - Mozaik Projekt</title>
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
            margin-bottom: 1.5rem;
            color: #1a1a2e;
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

        .btn {
            padding: 0.5rem 1.25rem;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.2s;
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
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }

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

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group .label {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
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

        @if($errors->any())
            <div class="error-message">
                <ul style="margin-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="book-detail">
            <h1>Add New Book</h1>

            <form method="POST" action="/books/create" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <div class="label">Title</div>
                    <input type="text" name="title" value="{{ old('title') }}" class="edit-input edit-input-title" placeholder="Book title" required>
                </div>

                <div class="form-group">
                    <div class="label">Author</div>
                    <input type="text" name="author" value="{{ old('author') }}" class="edit-input edit-input-author" placeholder="Author name" required>
                </div>

                <hr class="divider">

                <div class="book-info">
                    <div class="info-item">
                        <div class="label">Published Year</div>
                        <input type="number" name="published_year" value="{{ old('published_year') }}" class="edit-input" placeholder="e.g. 2024" required>
                    </div>
                    <div class="info-item">
                        <div class="label">Units Sold</div>
                        <input type="number" name="units_sold" value="{{ old('units_sold', 0) }}" class="edit-input">
                    </div>
                    <div class="info-item">
                        <div class="label">Remaining Stock</div>
                        <input type="number" name="remaining_stock" value="{{ old('remaining_stock', 0) }}" class="edit-input">
                    </div>
                </div>

                <hr class="divider">

                <div class="form-group">
                    <div class="label">Description</div>
                    <textarea name="description" class="edit-input" rows="4" style="resize: vertical;" placeholder="Book description...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <div class="label">Cover Image</div>
                    <input type="file" name="image" accept="image/*" class="edit-input">
                </div>

                <div class="btn-group">
                    <a href="/" class="btn btn-cancel">Cancel</a>
                    <button type="submit" class="btn btn-save">Add Book</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
