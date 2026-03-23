export default defineNuxtPlugin((nuxtApp) => {
  const config = useRuntimeConfig()
  const baseURL = import.meta.server ? config.apiBase : config.public.apiBase
  const getLocale = () => {
    const locale = nuxtApp.$i18n?.locale?.value
    return locale || 'ru'
  }

  const request = $fetch.create({
    baseURL,
    onRequest({ options }) {
      const headers = new Headers(options.headers || {})
      headers.set('Accept-Language', getLocale())
      options.headers = headers
    }
  })

  const client = {
    async $get(url, options = {}) {
      return await request(url, {
        ...options,
        method: 'GET'
      })
    },
    async $post(url, body, options = {}) {
      return await request(url, {
        ...options,
        body,
        method: 'POST'
      })
    },
    async get(url, options = {}) {
      return {
        data: await request(url, {
          ...options,
          method: 'GET'
        })
      }
    },
    async post(url, body, options = {}) {
      return {
        data: await request(url, {
          ...options,
          body,
          method: 'POST'
        })
      }
    }
  }

  return {
    provide: {
      axios: client
    }
  }
})
