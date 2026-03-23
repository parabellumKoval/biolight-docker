export const state = () => ({
	menu: {
		isShow: false,
		data: []
	},	
	footerMenu: {
		data: []
	},	
	crossMenu: {
		data: []
	},
	lang: {
		isShow: false
	},
	contacts: {
		isShow: false
	},
	order: {
		isShow: false,
		data: {
			name: ''
		}
	},
	products: {},
	product: {},
	category: {},
	page: {},
	settings: [],
	article: {},
	articles: {}
})

export const mutations = {
	show(state, value){
		state[value].isShow = true
	},
	close(state, value){
		state[value].isShow = false
	},
	toggle(state, value){
		state[value].isShow = !state[value].isShow
	},
	setOrder(state, value){
		state.order.data = value
	},
	setMenu(state, value){
		state.menu.data = value
	},
	setFooterMenu(state, value){
		state.footerMenu.data = value
	},
	setCrossMenu(state, value){
		state.crossMenu.data = value
	},
	setProducts(state, value){
		state.products = value
	},
	setProduct(state, value){
		state.product = value
	},
	setCategory(state, value){
		state.category = value
	},
	setPage(state, value){
		state.page = value
	},
	setSettings(state, value){
		state.settings = value
	},
	setArticle(state, value){
		state.article = value
	},
	setArticles(state, value){
		state.articles = value
	}
}

export const actions = {
	getMenu({ commit }){
		return this.$axios.$get('mn/25').then(response => {
        	commit('setMenu', response)
        	return response
      	});
	},
	getFooterMenu({ commit }){
		return this.$axios.$get('mn/24').then(response => {
        	commit('setFooterMenu', response)
        	return response
      	});
	},
	getCrossMenu({ commit }){
		return this.$axios.$get('mn/26').then(response => {
        	commit('setCrossMenu', response)
        	return response
      	});
	},
	getProducts({ commit }, query){
		
		if(query)
			query = '?' + query
		
		return this.$axios.$get('products' + query).then(response => {
        	commit('setProducts', response)
        	return response
      	});
	},
	getProduct({ commit }, slug){
		return this.$axios.$get('products/' + slug).then(response => {
        	commit('setProduct', response)
        	commit('setCategory', {name: response.category_name})
        	return response
      	});
	},
	getCategory({ commit }, slug){
		return this.$axios.$get('productCategories/' + slug).then(response => {
        	commit('setCategory', response)
        	return response
      	});
	},
	getPage({ commit }, slug){
		return this.$axios.$get('pages/' + slug).then(response => {
        	commit('setPage', response)
        	return response
      	});
	},
	getSettings({ commit }){
		return this.$axios.$get('settings').then(response => {
        	commit('setSettings', response)
        	return response
      	});
	},
	getArticles({ commit }){
		return this.$axios.$get('blog').then(response => {
// 					const resp = JSON.parse(JSON.stringify(response)) 
        	commit('setArticles', response)
        	return response
      	});
	},
	getArticle({ commit }, slug){
		return this.$axios.$get('blog/' + slug).then(response => {
        	commit('setArticle', response)
        	return response
      	});
	}
}

export const getters = {
}
