export const form = {
	data() {
		return {
			errors: {},
			data: {
				name: '',
				email: '',
				phone: '',
				text: '',
			}
		}
	},
	watch: {
		'data.name':{
			handler() {
				this.errors.name = null
			}
		},
		'data.email':{
			handler() {
				this.errors.email = null
			}
		},
		'data.phone':{
			handler() {
				this.errors.phone = null
			}
		},
		'data.text':{
			handler() {
				this.errors.text = null
			}
		}
	},
	methods: {
		notify(payload = {}) {
			const { $notify } = useNuxtApp()

			if (typeof $notify === 'function') {
				$notify({
					group: 'header',
					...payload
				})
			}
		},
		resetForm() {
			this.errors = {}
			this.data = {
				name: '',
				email: '',
				phone: '',
				text: '',
			}
		},
		async send() {
			this.errors = {}

			try {
				const response = await this.$axios.post('fb', this.data)

				if (response.data.type === 'error') {
					this.errors = response.data.errors || {}

					this.notify({
						title: this.$t('title.error'),
						text: this.$t('title.ckeck_fields'),
						type: 'error'
					})
					return
				}

				this.resetForm()
				this.$store.commit('close', 'order')

				this.notify({
					title: this.$t('title.thank'),
					text: this.$t('title.was_send'),
					type: 'success'
				})
			} catch (error) {
				const response = error?.response
				const responseData = response?._data || response?.data || {}

				if (response?.status === 422 || responseData.type === 'error') {
					this.errors = responseData.errors || {}

					this.notify({
						title: this.$t('title.error'),
						text: this.$t('title.ckeck_fields'),
						type: 'error'
					})
					return
				}

				console.error(error)
				this.notify({
					title: this.$t('title.error'),
					text: responseData.message || error?.message || this.$t('title.ckeck_fields'),
					type: 'error'
				})
			}
		}
	}
}
