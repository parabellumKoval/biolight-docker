# Прод-развертывание BioLight

## Что изменено для прод-переезда

- Основные домены и URL вынесены в `.env.docker`.
- Поддерживаются 2 схемы:
  - один домен для сайта, API и админки;
  - отдельный frontend-домен и отдельный backend-домен для `admin/api/phpMyAdmin`.
- Регистрация в Laravel Backpack закрыта по умолчанию.
- Добавлен тестовый сценарий перевыпуска SSL через staging Let's Encrypt.
- Локальный `.env.docker` больше не должен храниться в git.

## 1. Что редактировать

Для прода нужно редактировать только файл `.env.docker`.

Создание файла:

```bash
cp .env.docker.example .env.docker
```

## 2. Какие переменные обязательны

Минимально заполнить:

```dotenv
APP_KEY=
APP_URL=https://example.com
ADMIN_URL=https://admin.example.com

FRONTEND_DOMAIN=example.com
FRONTEND_SERVER_ALIASES=www.example.com

BACKEND_DOMAIN=admin.example.com
BACKEND_SERVER_ALIASES=

MYSQL_ROOT_PASSWORD=...
MYSQL_DATABASE=biolight
MYSQL_USER=biolight
MYSQL_PASSWORD=...

CERTBOT_EMAIL=admin@example.com
CERTBOT_PRIMARY_DOMAIN=example.com
CERTBOT_DOMAINS=example.com,www.example.com,admin.example.com

DOCKER_DATA_DIR=/opt/biolight/data
```

`APP_KEY` можно сгенерировать так:

```bash
docker compose --env-file .env.docker run --rm api php artisan key:generate --show
```

## 3. Где прописывать домены

### Вариант A. Один домен на всё

```dotenv
APP_URL=https://biolight.com.ua
ADMIN_URL=

FRONTEND_DOMAIN=biolight.com.ua
FRONTEND_SERVER_ALIASES=www.biolight.com.ua

BACKEND_DOMAIN=biolight.com.ua
BACKEND_SERVER_ALIASES=

NUXT4_SITE_URL=https://biolight.com.ua
NUXT4_BROWSER_ORIGIN=https://biolight.com.ua
NUXT4_API_BASE_PUBLIC=/api/
NUXT4_UPLOADS_ORIGIN=

CERTBOT_PRIMARY_DOMAIN=biolight.com.ua
CERTBOT_DOMAINS=biolight.com.ua,www.biolight.com.ua
```

Результат:

- сайт: `https://biolight.com.ua/`
- API: `https://biolight.com.ua/api/...`
- админка: `https://biolight.com.ua/admin`

### Вариант B. Сайт и backend на разных доменах

Пример:

```dotenv
APP_URL=https://biolight.com.ua
ADMIN_URL=https://admin.biolight.com.ua

FRONTEND_DOMAIN=biolight.com.ua
FRONTEND_SERVER_ALIASES=www.biolight.com.ua

BACKEND_DOMAIN=admin.biolight.com.ua
BACKEND_SERVER_ALIASES=

NUXT4_SITE_URL=https://biolight.com.ua
NUXT4_BROWSER_ORIGIN=https://biolight.com.ua
NUXT4_API_BASE_PUBLIC=/api/
NUXT4_UPLOADS_ORIGIN=https://admin.biolight.com.ua

CERTBOT_PRIMARY_DOMAIN=biolight.com.ua
CERTBOT_DOMAINS=biolight.com.ua,www.biolight.com.ua,admin.biolight.com.ua
```

Что важно:

- сайт открывается на `FRONTEND_DOMAIN`;
- админка, API и phpMyAdmin доступны напрямую на `BACKEND_DOMAIN`;
- frontend-домен при этом тоже проксирует `/api`, `/admin`, `/uploads`, поэтому публичная часть не ломается;
- если в письмах нужна ссылка именно на админку, используется `ADMIN_URL`.

## 4. Что с портом `:8888`

Старый вариант вида `https://biolight.com.ua:8888` больше не нужен.

Для прод-режима правильнее использовать отдельный backend-домен, например:

- `https://biolight.com.ua`
- `https://admin.biolight.com.ua`

Это проще для SSL, проще для SEO и проще для поддержки.

Если очень нужен внешний нестандартный порт, это уже отдельная инфраструктурная схема, и в текущей конфигурации она не закладывалась как основной вариант.

## 5. Запуск на сервере

Первичная подготовка:

```bash
git clone <repo>
cd biolight
cp .env.docker.example .env.docker
```

Заполнить `.env.docker`, затем:

```bash
make setup
make prod.bup
make ps
```

Проверить:

- сайт;
- `/admin`;
- `/api/products`;
- `/phpmyadmin/`.

## 6. Как выпустить SSL-сертификат

Обычный продовый запуск `make prod.bup` уже поднимает `certbot`.

Сертификат выпускается через webroot и подхватывается `nginx` автоматически.

Для этого должны быть:

- корректно настроены DNS-записи;
- открыты порты `80` и `443`;
- `CERTBOT_DOMAINS` должен содержать все нужные домены;
- `CERTBOT_PRIMARY_DOMAIN` должен совпадать с первым сертификатным доменом.

Проверка статуса сертификатов:

```bash
make cert.status MODE=prod
```

## 7. Как проверить перевыпуск сертификата безопасно

Для проверки добавлен тестовый сценарий на staging Let's Encrypt.

Запуск:

```bash
make cert.test MODE=prod
```

Что делает команда:

- запускает certbot в staging-режиме;
- принудительно перевыпускает сертификат;
- перезагружает `nginx`;
- показывает итоговый статус сертификатов.

Это почти тот же рабочий сценарий, что и в проде, но без боевых лимитов Let's Encrypt.

Проверка после запуска:

```bash
make cert.status MODE=prod
```

После этого нужно проверить:

- сертификаты видны в `certbot certificates`;
- сайт и админка открываются;
- `nginx` поднял новый сертификат без ошибок.

## 8. Как настроено автообновление

Автообновление сертификата уже включено контейнером `certbot`.

Основная переменная:

```dotenv
CERTBOT_RENEW_INTERVAL=12h
```

Важно:

- не надо ставить график раз в 3 месяца;
- правильная практика: проверять часто, например каждые `12h`;
- certbot сам не будет перевыпускать сертификат без необходимости.

То есть после теста ничего “переключать” на `90d` не нужно. Оставьте `12h`.

Если нужен единичный боевой запуск без staging:

```bash
make cert.renew MODE=prod
```

## 9. Куда складываются данные и volumes

Основные persistent-данные:

- MySQL: `${DOCKER_DATA_DIR}/mysql/data`
- SQL-дампы: `${DOCKER_DATA_DIR}/mysql/dumps`
- Laravel storage: `${DOCKER_DATA_DIR}/api/storage`
- Laravel bootstrap cache: `${DOCKER_DATA_DIR}/api/bootstrap-cache`
- Загруженные файлы и картинки: `${DOCKER_DATA_DIR}/api/uploads`

Рекомендация для прод-сервера:

```dotenv
DOCKER_DATA_DIR=/opt/biolight/data
```

Так данные живут вне git-репозитория и не мешают `git pull`.

## 10. Куда загружать картинки товаров для админки

Если загружать через Backpack, система сама пишет файлы в:

```text
${DOCKER_DATA_DIR}/api/uploads/products
```

Если нужно загрузить вручную при миграции, копировать нужно в:

```text
${DOCKER_DATA_DIR}/api/uploads
```

Для карточек товаров обычно используются файлы в подпапке:

```text
${DOCKER_DATA_DIR}/api/uploads/products
```

Важно:

- не копируйте товарные изображения в `src/api/public/uploads` на прод-сервере;
- `src/api/public/uploads` нужен как seed для пустого volume при первом запуске контейнера;
- после запуска рабочие файлы живут в volume по пути `${DOCKER_DATA_DIR}/api/uploads`.

## 11. Что с gitignore и обновлениями проекта

Проверено и подготовлено:

- `.env.docker` должен быть локальным и не должен коммититься;
- `.docker/volumes` игнорируется;
- добавлены игноры для корневых `data` и `.data`;
- Nuxt build-cache и `node_modules` уже игнорируются.

Для прода это означает:

- не хранить рабочие данные внутри репозитория;
- использовать `DOCKER_DATA_DIR` вне репозитория;
- обновлять проект через `git pull`, не трогая data-папки.

## 12. Рекомендованный порядок обновления на проде

Перед обновлением:

```bash
make db.dump MODE=prod FILE=backup-$(date +%F-%H%M).sql
```

Обновление:

```bash
git pull
make prod.bup
make ps
```

После обновления проверить:

- сайт;
- админку;
- API;
- отправку формы;
- `make cert.status MODE=prod`.

## 13. Laravel Backpack

Регистрация в Backpack закрыта по умолчанию:

```dotenv
BACKPACK_REGISTRATION_OPEN=false
```

Даже если эту переменную не указать, регистрация теперь всё равно закрыта конфигом.

## 14. Что ещё учесть

- Если используется SMTP для заявок, заполните `MAIL_*` и `FEEDBACK_NOTIFICATION_EMAIL`.
- Если у вас отдельный backend-домен, в письмах ссылка на заявку будет строиться от `ADMIN_URL`.
- Если нужен Composer auth для приватных зависимостей, можно передать `COMPOSER_AUTH` через `.env.docker`.
