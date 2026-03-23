export const form = {
	data() {
		return {
			errors:{},
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
			send(){
				this.$axios.post('fb', this.data).then(response => {
					console.log(response);
				
				if(response.data.type === 'error'){
					this.errors = response.data.errors;
					
					this.$notify({
						  group: 'header',
						  title: this.$t('title.error'),
						  text: this.$t('title.ckeck_fields'),
						  type: 'error'
						});
				}else {
					
					this.data = {
						name: '',
						email: '',
						phone: '',
						text: '',
					}
					
					this.$store.commit('close', 'order')
					
					this.$notify({
						  group: 'header',
						  title: this.$t('title.thank'),
						  text: this.$t('title.was_send'),
						  type: 'success'
						});					
				}
			}).catch(errors => {
				console.log(errors);
			})
		}
	}
}
