# biolight nuxt4

Это отдельная копия проекта из `src/front`, перенесенная на Nuxt 4.

## Local

```bash
npm install
npm run dev
```

## Build

```bash
npm run build
npm run start
```

## Docker

Новый контейнер фронта подключен как `front4` в `docker-compose*.yml`.

В dev окружении он доступен на порту `DEV_NUXT4_PORT` из `.env.docker`.
