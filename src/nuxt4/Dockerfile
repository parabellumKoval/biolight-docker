FROM node:22-bookworm-slim AS deps

WORKDIR /app

COPY package*.json ./
RUN npm install

FROM node:22-bookworm-slim AS dev

WORKDIR /app

ENV NODE_ENV=development
ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=3000

CMD ["npm", "run", "dev"]

FROM deps AS builder

COPY . ./

RUN npm run build

FROM node:22-bookworm-slim

WORKDIR /app

ENV NODE_ENV=production
ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=3000

COPY --from=builder /app /app

EXPOSE 3000

CMD ["npm", "run", "start"]
