<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заявка</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #18181b; }
        h1 { font-size: 18px; margin: 0 0 16px; }
        .row { margin-bottom: 8px; }
        .k { font-weight: bold; }
        .box { margin-top: 16px; padding: 12px; border: 1px solid #d4d4d8; border-radius: 4px; }
        .mono { font-size: 10px; word-break: break-all; }
    </style>
</head>
<body>
    <h1>Заявка</h1>

    <div class="row"><span class="k">ФИО:</span> {{ $fullName }}</div>
    <div class="row"><span class="k">ИИН:</span> {{ $iin }}</div>
    <div class="row"><span class="k">Дата:</span> {{ $date }}</div>

    <div class="box">
        <div class="k">Текст</div>
        <div>{{ $text }}</div>
    </div>
</body>
</html>
