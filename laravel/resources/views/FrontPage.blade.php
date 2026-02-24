<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mozaik Projekt</title>
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

        /* Navigation */
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

        nav .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        nav .nav-links a {
            color: #ccc;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.2s;
        }

        nav .nav-links a:hover {
            color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid #1a1a2e;
            padding-bottom: 0.5rem;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card h3 {
            margin-bottom: 0.5rem;
        }

        .card p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Filter Bar */
        .filter-bar {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            padding: 1rem 2rem;
        }

        .filter-bar form {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-bar input,
        .filter-bar select {
            padding: 0.5rem 0.75rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.9rem;
            background: #f9f9f9;
        }

        .filter-bar input:focus,
        .filter-bar select:focus {
            outline: none;
            border-color: #1a1a2e;
        }

        .filter-bar input[type="text"] {
            flex: 1;
            min-width: 200px;
        }

        .filter-bar button {
            padding: 0.5rem 1.25rem;
            background-color: #1a1a2e;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .filter-bar button:hover {
            background-color: #16213e;
        }

        .filter-bar .filter-reset {
            background: none;
            color: #888;
            text-decoration: underline;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            padding: 0;
        }

        .filter-bar .filter-reset:hover {
            color: #333;
        }

        .add-button {
            display: inline-block;
            padding: 0.6rem 1.25rem;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            transition: background-color 0.2s;
        }

        .add-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <nav>
        <a href="/" class="logo">Mozaik Projekt</a>
    </nav>

    <div class="filter-bar">
        <form method="GET" action="/">
            <input type="text" name="search" placeholder="Search by title or author..." value="{{ request('search') }}">

            <select name="sort">
                <option value="" disabled {{ request('sort') ? '' : 'selected' }}>Sort by</option>
                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Newest First</option>
                <option value="year_asc" {{ request('sort') == 'year_asc' ? 'selected' : '' }}>Oldest First</option>
                <option value="sold_desc" {{ request('sort') == 'sold_desc' ? 'selected' : '' }}>Most Sold</option>
                <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Most Stock</option>
                <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>Least Stock</option>
            </select>

            <button type="submit">Filter</button>
            <a href="/" class="filter-reset">Reset</a>
        </form>
    </div>

    <div class="container">
        <h2 class="section-title">Books</h2>
        <a href="/books/add" class="add-button">Add New Book</a>
        <div class="content-grid">
            @foreach ($books as $book)
                <a href="/books/{{ $book->id }}" class="card-link">
                    <div class="card">
                        <h3>{{ $book->title }}</h3>
                        <p>{{ $book->author }} ({{ $book->published_year }})</p>
                        <p>Remaining Stock: {{ $book->remaining_stock }}</p>
                        <p>Units Sold: {{ $book->units_sold }}</p>
                    </div>
                </a>
            @endforeach
        </div>

</body>
</html>