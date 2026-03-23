<template>
	<div class="container">
		<div class="catalog">
			<h1 class="title">{{ page.name }}</h1>
			<div class="items">
				<ProductCard v-for="product in products.data" :data="product" :key="product.id" />
			</div>
			
			<BasePagination :loading="false" :data-meta="products.meta" @changePage="changePage"/>
			
			<div class="seo-text" v-html="seoText"></div>
		</div>
	</div>
</template>
<script>
	export default {
	data() {
		return {
			page: this.$store.state.page,
			products: this.$store.state.products && this.$store.state.products.data
				? { ...this.$store.state.products }
				: {
					data: [],
					meta: {
	          current_page: 1,
	          last_page: 10
					}
				},
			per_page: 12,
			pagination: {
				page: 1,
				append: false
			}
		}
	},
	watch: {
		'$store.state.page': {
			immediate: true,
			deep: true,
			handler(v) {
				if(!v)
					return
				
				this.page = v
			}
		},
			'$store.state.products': {
			immediate: true,
			deep: true,
			handler(v) {
				if (v && v.data) {
					this.products = { ...v }
				}
			}
		}
	},
		computed: {
			seoText(){
				return this.page && this.page.seo && this.page.seo.meta_text
			},
			query(){
				let query = {};
				
				query.per_page = this.per_page
				
				let slug = this.$route.params.page
				if(slug)
					query.category_slug = slug
				
				if(this.pagination.page && this.pagination.page != 1)
					query.page = this.pagination.page
				
				return new URLSearchParams(query).toString()
			}
		},
		methods: {
			getProducts(){
				this.$store.dispatch('getProducts', this.query).then(response => {
					
					const pr_data = response.data
					const pr_meta = response.meta
					
					if(this.pagination.append){
						this.products.data = this.products.data.concat(pr_data)
						this.products.meta = pr_meta
					}else
				  	this.products = response
			  }) 				
			},
			changePage(v) {
				this.pagination = v
				this.getProducts()
			}
		},
	}
</script>
<style lang='scss' src='@/assets/scss/pages/catalog/category.scss' scoped></style>
<style lang='scss'>
	.seo-text {
		margin: 100px 0;
		line-height: 160%;
		
		p { 
			margin-bottom: 25px;
		}
	}
</style>
