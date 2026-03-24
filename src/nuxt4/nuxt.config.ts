const apiBase =
  process.env.NUXT_API_BASE ??
  process.env.NUXT4_API_INTERNAL_URL ??
  process.env.NUXT4_API_BASE_URL ??
  process.env.NUXT_API_BASE_URL ??
  'http://api:8080/api/'

const browserOrigin =
  process.env.NUXT_PUBLIC_BROWSER_ORIGIN ??
  process.env.NUXT4_BROWSER_ORIGIN ??
  (process.env.NODE_ENV === 'development' ? 'http://localhost:8088' : '')

const publicApiBase =
  process.env.NUXT_PUBLIC_API_BASE ??
  process.env.NUXT4_API_BASE_PUBLIC ??
  '/api/'

const uploadsOrigin =
  process.env.NUXT_PUBLIC_UPLOADS_ORIGIN ??
  process.env.NUXT4_UPLOADS_ORIGIN ??
  ''

const siteUrl =
  process.env.NUXT_PUBLIC_SITE_URL ??
  process.env.NUXT4_SITE_URL ??
  (browserOrigin || 'https://example.com')

const apiOrigin = /^https?:\/\//.test(apiBase)
  ? apiBase.replace(/\/api\/?$/, '').replace(/\/+$/, '')
  : ''

const imageDomains = Array.from(
  new Set(
    [
      'api',
      'localhost',
      '127.0.0.1',
      ...((process.env.NUXT4_IMAGE_DOMAINS || '')
        .split(',')
        .map((item) => item.trim())
        .filter(Boolean)
        .flatMap((value) => {
          try {
            return /^https?:\/\//.test(value) ? [new URL(value).hostname] : [value]
          } catch {
            return [value]
          }
        })),
      ...[browserOrigin, siteUrl, publicApiBase, uploadsOrigin]
        .filter(Boolean)
        .flatMap((value) => {
          try {
            return /^https?:\/\//.test(value) ? [new URL(value).hostname] : []
          } catch {
            return []
          }
        })
    ].filter(Boolean)
  )
)

export default defineNuxtConfig({
  ssr: true,

  css: ['~/assets/scss/global/_index.scss'],

  components: true,

  modules: ['@nuxtjs/i18n', '@nuxt/image'],

  runtimeConfig: {
    apiBase,
    public: {
      apiBase: publicApiBase,
      browserOrigin,
      // Used by Nuxt Image (IPX) to fetch uploaded images from the API in a stable way on both SSR + client.
      // Can be overridden via `NUXT4_UPLOADS_ORIGIN`. Example: `https://admin.example.com`.
      uploadsOrigin: uploadsOrigin || apiOrigin,
      siteUrl
    }
  },

  image: {
    provider: 'ipx',
    domains: imageDomains
  },

  nitro: {
    devProxy: {
      '/api': {
        target: apiBase,
        changeOrigin: true
      },
      // Uploaded images are served from the Laravel API container under `/uploads/...`.
      // In dev, Nuxt runs on `localhost:3080`, so without this proxy `/uploads/...` would 404.
      '/uploads': {
        target: apiOrigin || 'http://api:8080',
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
    baseUrl: siteUrl,
    locales: [
      {
        code: 'ru',
        file: 'ru.yaml',
        language: 'ru-RU',
        name: 'Русский',
        shortName: 'RU',
        icon: '/assets/icons/ru.svg'
      },
      {
        code: 'uk',
        file: 'uk.yaml',
        language: 'uk-UA',
        name: 'Українська',
        shortName: 'UA',
        icon: '/assets/icons/ua.svg'
      },
      {
        code: 'en',
        file: 'en.yaml',
        language: 'en-US',
        name: 'English',
        shortName: 'EN',
        icon: '/assets/icons/en.svg'
      }
    ]
  }
})
