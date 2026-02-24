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

        .card h3 {
            margin-bottom: 0.5rem;
        }

        .card p {
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <nav>
        <a href="/" class="logo">Mozaik Projekt</a>
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/books">Books</a></li>
        </ul>
    </nav>

    <div class="container">

        {{-- Section: Books from DB --}}
        <h2 class="section-title">Books</h2>
        <div class="content-grid">
            @foreach ($books as $book)
                <div class="card">
                    <h3>{{ $book->title }}</h3>
                    <p>{{ $book->author }} ({{ $book->published_year }})</p>
                </div>
            @endforeach
        </div>

        <h2 class="section-title">Featured</h2>
        <div class="content-grid">
            {{-- Placeholder cards --}}
        </div>

        <h2 class ="section-title">Most Sold</h2>
        <div class="content-grid">
            {{-- Placeholder cards --}} 
        </div>
    </div>

</body>
</html>