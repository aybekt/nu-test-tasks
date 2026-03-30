# Тестовые задания NU

Две части с **отдельным Docker Compose** каждая (нужден установленный **Docker**)

| Часть | Каталог | URL после запуска |
|-------|---------|-------------------|
| 1. WordPress + плагин + nginx fallback | `wordpress/` | http://localhost:8080 |
| 2. Laravel + PDF | `laravel/` | http://localhost:8081 |

Часть 3 (аналитика): `docs/nu-site-analysis.md`.

---

## Часть 1 — WordPress

```bash
cd wordpress
docker compose up -d --build
```

- Главная `http://localhost:8080/` отдаёт **статический** `static/index.html` (fallback).
- Админка: `http://localhost:8080/wp-admin/` - при первом запуске нужно установить WordPress, а затем активировать плагин **NU Custom Admin**.
- Архитектура fallback: `wordpress/ARCHITECTURE.md`.

Остановка: `docker compose down`.

---

## Часть 2 — Laravel

```bash
cd laravel
docker compose up -d --build
```

Открываем в браузере http://localhost:8081 — форма **ФИО, ИИН, дата, текст**.

- **Скачать PDF** — скачивается файл `zayavka.pdf`.

Подробности: `laravel/README.md`.

---

## Часть 3 — Аналитика

Файл: `docs/nu-site-analysis.md` (UX/UI, Performance, SEO, архитектура, сильные стороны, приоритет).
