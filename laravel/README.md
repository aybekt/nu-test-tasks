# Часть 2 — Laravel (Docker)

Один контейнер: **PHP 8.4 + Apache**, зависимости ставятся при сборке образа (`composer`). Локально нужен только **Docker**.

## Запуск

```bash
cd laravel
docker compose up -d --build
```

Приложение: **http://localhost:8081**

## Функциональность

- Форма: ФИО, ИИН, дата, текст (валидация на сервере).
- Кнопка **«Скачать PDF»** — ответ с файлом `zayavka.pdf`.

## Остановка

```bash
docker compose down
```

## Пересборка после изменений кода

```bash
docker compose up -d --build
```
