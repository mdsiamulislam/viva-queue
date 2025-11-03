<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viva Queue System</title>

    {{-- Optional: Simple CSS --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 0;
        }
        header {
            background: #28a745;
            color: white;
            padding: 10px 20px;
        }
        main {
            padding: 20px;
        }
        .alert {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            cursor: pointer;
        }
        input {
            padding: 6px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background: #eee;
        }
        ol {
            background: white;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <header>
        <h2>Viva Queue System</h2>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>
