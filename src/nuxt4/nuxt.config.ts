export default defineNuxtConfig({
  ssr: true,

  css: ['~/assets/scss/global/_index.scss'],

  components: true,

  modules: ['@nuxtjs/i18n', '@nuxt/image'],

  runtimeConfig: {
    apiBase: process.env.NUXT4_API_INTERNAL_URL ?? process.env.NUXT4_API_BASE_URL ?? process.env.NUXT_API_BASE_URL ?? 'http://api:8080/api/',
    public: {
      apiBase: process.env.NUXT4_API_BASE_PUBLIC ?? '/api/',
      // Used by Nuxt Image (IPX) to fetch uploaded images from the API in a stable way on both SSR + client.
      // Can be overridden via `NUXT4_UPLOADS_ORIGIN`. Example: `http://api:8080`.
      uploadsOrigin:
        process.env.NUXT4_UPLOADS_ORIGIN ??
        ((): string => {
          const base =
            process.env.NUXT4_API_INTERNAL_URL ??
            process.env.NUXT4_API_BASE_URL ??
            process.env.NUXT_API_BASE_URL ??
            'http://api:8080/api/'
          if (!/^https?:\/\//.test(base)) return ''
          return base.replace(/\/api\/?$/, '').replace(/\/+$/, '')
        })()
    }
  },

  image: {
    provider: 'ipx',
    // Allow optimizing images served by the API container in docker-compose (`http://api:8080/...`).
    domains: ['api', 'localhost', '127.0.0.1', 'biolight.com.ua', 'www.biolight.com.ua']
  },

  nitro: {
    devProxy: {
      '/api': {
        target: process.env.NUXT4_API_INTERNAL_URL ?? process.env.NUXT4_API_BASE_URL ?? process.env.NUXT_API_BASE_URL ?? 'http://api:8080/',
        changeOrigin: true
      },
      // Uploaded images are served from the Laravel API container under `/uploads/...`.
      // In dev, Nuxt runs on `localhost:3080`, so without this proxy `/uploads/...` would 404.
      '/uploads': {
        target: process.env.NUXT4_API_INTERNAL_URL ?? process.env.NUXT4_API_BASE_URL ?? process.env.NUXT_API_BASE_URL ?? 'http://api:8080/',
        changeOrigin: true
      }
    }
  },

  app: {
    head: {
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { name: 'format-detection', content: 'telephone=no' }
      ],
      link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon-32x32.png' }]
    }
  },

  i18n: {
    strategy: 'prefix_except_default',
    defaultLocale: 'ru',
    lazy: true,
    langDir: 'lang',
    vueI18n: './i18n/i18n.config.ts',
    baseUrl: 'https://biolight.com.ua',
    locales: [
      {
        code: 'ru',
        file: 'ru.js',
        language: 'ru-RU',
        name: 'Русский',
        shortName: 'RU',
        icon: '/assets/icons/ru.svg'
      },
      {
        code: 'uk',
        file: 'uk.js',
        language: 'uk-UA',
        name: 'Українська',
        shortName: 'UA',
        icon: '/assets/icons/ua.svg'
      },
      {
        code: 'en',
        file: 'en.js',
        language: 'en-US',
        name: 'English',
        shortName: 'EN',
        icon: '/assets/icons/en.svg'
      }
    ]
  }
})
