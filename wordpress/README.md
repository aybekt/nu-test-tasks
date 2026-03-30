# Часть 1 — WordPress (Docker)

Требуется только **Docker** (и Docker Compose).

## Запуск

```bash
cd wordpress
docker compose up -d
```

Откройте в браузере (порт **8080**):

- **Сайт (через nginx с fallback):** http://localhost:8080/
- **Установка WordPress:** http://localhost:8080/wp-admin/install.php  
- **Админка:** http://localhost:8080/wp-admin/

Пока лежит `static/index.html`, главная `/` отдаётся как статика; установка всегда через `/wp-admin/`.

После установки WP активируйте плагин **NU Custom Admin** в разделе «Плагины».

## Плагин

Путь: `wp-content/plugins/nu-custom-admin/nu-custom-admin.php`

- скрывает типы **Записи** и **Страницы** в меню админки;
- добавляет пункт **«Кастомный раздел NU»** с произвольным контентом;
- блокирует прямой заход в списки записей/страниц (редирект на кастомную страницу).

## Fallback на статику

Описание: см. [ARCHITECTURE.md](./ARCHITECTURE.md).

Чтобы увидеть динамическую главную WordPress, временно переименуйте или удалите `static/index.html` и обновите страницу (при необходимости очистите кеш браузера).

## Если «ломаются» стили, картинки или ссылки ведут на `http://localhost` без порта

Прокси передаёт в WordPress заголовок `Host` **с портом** (`localhost:8080`). После правок в `nginx/` перезапустите только прокси:

```bash
docker compose restart proxy
```

Жёсткое обновление страницы в браузере (Ctrl+F5). В `docker-compose.yml` заданы `WP_HOME` / `WP_SITEURL` на `http://localhost:8080`.

Если сайт ставили раньше и в базе остались старые URL, в таблице `wp_options` (MariaDB) обновите `home` и `siteurl` на `http://localhost:8080`. Константы `WP_HOME` / `WP_SITEURL` в `docker-compose.yml` тоже фиксируют адрес для новых установок.

## Остановка

```bash
docker compose down
```

Данные БД и файлы WP сохраняются в Docker volumes (`wp_db_data`, `wp_html`).
