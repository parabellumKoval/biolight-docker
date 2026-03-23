<template>
	<section class="crumbs">
      <div class="container">

        <div class="crumbs__inner">
			  	<transition name="fade">
				    <nav class="crumbs__route" aria-label="breadcrumbs" v-if="crumbs.length">
			          <ul>
			            <li>
			              <nuxt-link :to="localePath('/')"  class="crumbs__link">{{ $t('route.home') }}</nuxt-link>
			              <span class="delimiter">/</span>
			            </li>
			            <li v-for="(item, i) in crumbs" :key="i" :class="item.classes">
			              <nuxt-link :to="localePath(item.path)"  class="crumbs__link">{{ item.crumb }}</nuxt-link>
			              <span v-if="i+1 < crumbs.length" class="delimiter">/</span>
			            </li>
			          </ul>
			        </nav>
					</transition>
        </div>

      </div>
    </section>
</template>
<script>
	export default {
		setup() {
			const localePath = useLocalePath()
			return { localePath }
		},
		mixins: [],
		data() {
			return {
				watchers: [],
				crumbs: []
			}
		},
		props: {
			showBack: {
				type: Boolean,
				default: true
			} 	
		},
		methods: {
			generate(){
				this.crumbs = []
					
				let paths = this.$route.path.split('/').filter((item)=>{return item !== ''});
				
				this.$route.matched.forEach((item) => {
					
					let segments = item.path.split('/').map((segment, i, {length}) => {
						
						if(segment === '')
							return
						
						
						let match = segment.match('^:([a-z.]+)');
						
						if(segment === 'ru' || segment === 'uk' || segment === 'en')
							return
						
						let data = match && match[1] && this.$store.state && this.$store.state[match[1]] && (this.$store.state[match[1]].title || this.$store.state[match[1]].name || null)

						
						this.crumbs.push({
							name: item.name,
							path: '/' + paths.slice(0, i).join('/'),
							crumb: data || this.$t('route.' + segment),
							classes: i === length - 1? 'active': null
						})
						
					})

				})
				
			}
		},
		watch: {
			'$store.state.page.title': {
				deep: true,
				immediate: true,
				handler(){
						this.generate()
				}				
			},
			'$store.state.category.name': {
				deep: true,
				immediate: true,
				handler(){
						this.generate()
				}				
			},
			'$store.state.product.name': {
				deep: true,
				immediate: true,
				handler(){
						this.generate()
				}				
			},
			'$store.state.article.name': {
				deep: true,
				immediate: true,
				handler(v){
						this.generate()
				}				
			},
			'$route.params': {
				deep: true,
				immediate: true,
				handler(){
						this.generate()
				}				
			}
		},
		mounted() {
			this.generate()
		}
	}
</script>
<style lang="scss">
	
</style>
<style lang='scss' src='@/assets/scss/components/the-header-breadcrumbs.scss' scoped></style>
