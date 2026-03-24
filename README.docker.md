# Docker инфраструктура

Подробная пошаговая инструкция для прод-сервера: [PROD_DEPLOY.md](./PROD_DEPLOY.md)

Этот проект развернут в Docker со следующими контейнерами:

- `api` (Laravel API + Backpack admin)
- `front4` (Nuxt frontend)
- `mysql`
- `phpmyadmin`
- `nginx` (reverse proxy)
- `certbot` (автовыпуск/обновление Let's Encrypt)

Все кастомные Docker-образы и конфиги лежат в `.docker/`.

## 1) Подготовка env

```bash
cp .env.docker.example .env.docker
```

Заполните в `.env.docker` минимум:

- `DOMAIN`
- `SERVER_ALIASES` (опционально)
- `CERTBOT_EMAIL`
- `CERTBOT_DOMAINS` (через запятую, первый домен должен совпадать с `DOMAIN`)
- `MYSQL_*`
- `APP_URL`
- `APP_KEY`
- `DOCKER_DATA_DIR` (по умолчанию `.docker/volumes`)

Сгенерировать `APP_KEY` можно так:

```bash
docker compose --env-file .env.docker run --rm api php artisan key:generate --show
```

## 2) Запуск

```bash
make setup
make bup
```

Если хотите, чтобы `make bup` без `MODE=` запускал dev-стек, задайте `DEFAULT_MODE=dev` в `.env.docker`.

Проверка:

```bash
make ps
make logs
```

## 3) Режимы

- `MODE=prod` использует продовый compose-профиль и поднимает `certbot`
- `MODE=dev` поднимает фронт через `nuxt` dev server и монтирует исходники из `src/`
- Значение по умолчанию берётся из `DEFAULT_MODE` в `.env.docker`

Примеры:

```bash
make up MODE=dev
make api.logs MODE=dev
make api.exec MODE=dev CMD="php artisan tinker"
make api.bup MODE=dev
```

## 4) Доступ

- Frontend: `https://<DOMAIN>/`
- API: `https://<DOMAIN>/api/...`
- Admin (Backpack): `https://<DOMAIN>/admin`
- phpMyAdmin: `https://<DOMAIN>/phpmyadmin/`

В dev-режиме фронт доступен на `http://localhost:8088/` по умолчанию.

Пока сертификат не выпущен, `nginx` работает в HTTP-режиме. После получения сертификата контейнер автоматически переключится на HTTPS и будет периодически делать `reload` для подхвата обновленных сертификатов.

## 5) Важно по структуре проекта

- Laravel: `src/api`
- Frontend (Nuxt4): `src/nuxt4`
- Внешние данные и дампы: `.docker/volumes`

Docker-конфигурация использует именно эту структуру.
