export const state = () => ({
	dataFetched: true,
	slugs: {
		pages: [],
		categories:[]
	}
})

export const mutations = {
	setSlugs(state, value){
		state.slugs = value
	},
	setDataFetched(state, data) {
		state.dataFetched = data;
	}
}

export const actions = {
	getSlugs({ commit }){
		return this.$axios.$get('pages').then(response => {
      	commit('setSlugs', response)
      	return {...response}
    	});
	},
}
