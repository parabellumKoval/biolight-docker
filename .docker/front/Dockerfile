FROM node:16-bullseye-slim AS builder

WORKDIR /app

COPY src/front/package*.json ./
RUN npm ci

COPY src/front/ ./

RUN npm run build

FROM node:16-bullseye-slim

WORKDIR /app

ENV NODE_ENV=production
ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=3000

COPY --from=builder /app /app

EXPOSE 3000

CMD ["npm", "run", "start"]
