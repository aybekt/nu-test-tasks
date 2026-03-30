<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Заявка и PDF</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f4f5; margin: 0; }
        .box { max-width: 720px; margin: 32px auto; background: #fff; padding: 28px; border-radius: 12px; box-shadow: 0 1px 3px rgb(0 0 0 / 0.08); }
        h1 { margin-top: 0; font-size: 1.35rem; }
        label { display: block; font-weight: 600; margin-bottom: 6px; }
        input, textarea, select { width: 100%; box-sizing: border-box; padding: 10px 12px; margin-bottom: 4px; border: 1px solid #d4d4d8; border-radius: 8px; font-size: 1rem; }
        textarea { min-height: 140px; resize: vertical; }
        .err { color: #b91c1c; font-size: 0.875rem; margin-bottom: 12px; }
        .row-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 8px; }
        button { border: none; border-radius: 8px; padding: 10px 18px; font-size: 1rem; cursor: pointer; }
        .primary { background: #2563eb; color: #fff; }
        .hint { font-size: 0.9rem; color: #52525b; margin-bottom: 20px; line-height: 1.5; }
    </style>
</head>
<body>
<div class="box">
    <h1>Форма заявки</h1>
        <p class="hint">Заполните форму и скачайте PDF.</p>

        <form id="app-form" method="post" action="{{ route('application.pdf') }}">
        @csrf

        <label for="full_name">ФИО</label>
        <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required autocomplete="name">
        @error('full_name')<div class="err">{{ $message }}</div>@enderror

        <label for="iin">ИИН</label>
        <input id="iin" name="iin" type="text" inputmode="numeric" value="{{ old('iin') }}" required>
        @error('iin')<div class="err">{{ $message }}</div>@enderror

        <label for="date">Дата</label>
        <input id="date" name="date" type="date" value="{{ old('date') }}" required>
        @error('date')<div class="err">{{ $message }}</div>@enderror

        <label for="text">Текст</label>
        <textarea id="text" name="text" required>{{ old('text') }}</textarea>
        @error('text')<div class="err">{{ $message }}</div>@enderror

            <div class="row-actions">
                <button type="submit" class="primary">Скачать PDF</button>
            </div>
    </form>
</div>
</body>
</html>
