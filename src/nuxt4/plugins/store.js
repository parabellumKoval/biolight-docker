import { reactive } from 'vue'

const createInitialState = () => reactive({
  menu: useState('biolight.store.menu', () => ({
    isShow: false,
    data: []
  })),
  footerMenu: useState('biolight.store.footerMenu', () => ({
    data: []
  })),
  crossMenu: useState('biolight.store.crossMenu', () => ({
    data: []
  })),
  lang: useState('biolight.store.lang', () => ({
    isShow: false
  })),
  contacts: useState('biolight.store.contacts', () => ({
    isShow: false
  })),
  order: useState('biolight.store.order', () => ({
    isShow: false,
    data: {
      name: ''
    }
  })),
  products: useState('biolight.store.products', () => ({
    data: [],
    meta: {}
  })),
  product: useState('biolight.store.product', () => ({})),
  category: useState('biolight.store.category', () => ({})),
  page: useState('biolight.store.page', () => ({})),
  settings: useState('biolight.store.settings', () => ({
    phone: '',
    phone_2: '',
    email: '',
    time: '',
    address: '',
    telegram: '',
    viber: '',
    whatsup: ''
  })),
  article: useState('biolight.store.article', () => ({})),
  articles: useState('biolight.store.articles', () => ({
    data: [],
    meta: {}
  })),
  router: useState('biolight.store.router', () => ({
    dataFetched: true,
    slugs: {
      pages: [],
      categories: []
    }
  }))
})

export default defineNuxtPlugin((nuxtApp) => {
  const state = createInitialState()
  const axios = nuxtApp.$axios

  const commit = (type, value) => {
    switch (type) {
      case 'show':
        state[value].isShow = true
        break
      case 'close':
        state[value].isShow = false
        break
      case 'toggle':
        state[value].isShow = !state[value].isShow
        break
      case 'setOrder':
        state.order.data = value
        break
      case 'setMenu':
        state.menu.data = value
        break
      case 'setFooterMenu':
        state.footerMenu.data = value
        break
      case 'setCrossMenu':
        state.crossMenu.data = value
        break
      case 'setProducts':
        state.products = value
        break
      case 'setProduct':
        state.product = value
        break
      case 'setCategory':
        state.category = value
        break
      case 'setPage':
        state.page = value
        break
      case 'setSettings':
        state.settings = {
          ...state.settings,
          ...value
        }
        break
      case 'setArticle':
        state.article = value
        break
      case 'setArticles':
        state.articles = value
        break
      case 'router/setSlugs':
        state.router.slugs = value
        break
      case 'router/setDataFetched':
        state.router.dataFetched = value
        break
      default:
        break
    }
  }

  const dispatch = async (type, value) => {
    switch (type) {
      case 'getMenu': {
        const response = await axios.$get('mn/25')
        commit('setMenu', response)
        return response
      }
      case 'getFooterMenu': {
        const response = await axios.$get('mn/24')
        commit('setFooterMenu', response)
        return response
      }
      case 'getCrossMenu': {
        const response = await axios.$get('mn/26')
        commit('setCrossMenu', response)
        return response
      }
      case 'getProducts': {
        const query = value ? `?${value}` : ''
        const response = await axios.$get(`products${query}`)
        commit('setProducts', response)
        return response
      }
      case 'getProduct': {
        const response = await axios.$get(`products/${value}`)
        commit('setProduct', response)
        commit('setCategory', { name: response.category_name })
        return response
      }
      case 'getCategory': {
        const response = await axios.$get(`productCategories/${value}`)
        commit('setCategory', response)
        return response
      }
      case 'getPage': {
        const response = await axios.$get(`pages/${value}`)
        commit('setPage', response)
        return response
      }
      case 'getSettings': {
        const response = await axios.$get('settings')
        commit('setSettings', response)
        return response
      }
      case 'getArticles': {
        const response = await axios.$get('blog')
        commit('setArticles', response)
        return response
      }
      case 'getArticle': {
        const response = await axios.$get(`blog/${value}`)
        commit('setArticle', response)
        return response
      }
      case 'router/getSlugs': {
        const response = await axios.$get('pages')
        commit('router/setSlugs', response)
        return { ...response }
      }
      default:
        return null
    }
  }

  const store = {
    state,
    commit,
    dispatch
  }

  nuxtApp.provide('store', store)
})
