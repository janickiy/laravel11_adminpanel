<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каталог</title>
    <style>
        body {
            margin: 0;
            background: #f6f7f9;
            color: #1f2937;
            font-family: Arial, sans-serif;
        }

        .page {
            max-width: 960px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
            line-height: 1.2;
        }

        .admin-link {
            color: #2563eb;
            text-decoration: none;
        }

        .catalog-list {
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .catalog-item,
        .empty {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
            padding: 16px 18px;
        }

        .catalog-item {
            font-size: 18px;
            font-weight: 600;
        }

        .empty {
            color: #6b7280;
        }
    </style>
</head>
<body>
<main class="page">
    <header class="header">
        <h1>Каталог</h1>
        <a class="admin-link" href="{{ route('login') }}">Админка</a>
    </header>

    @if($catalogs->isNotEmpty())
        <ul class="catalog-list">
            @foreach($catalogs as $catalog)
                <li class="catalog-item">{{ $catalog->name }}</li>
            @endforeach
        </ul>
    @else
        <div class="empty">Каталог пока пуст.</div>
    @endif
</main>
</body>
</html>
