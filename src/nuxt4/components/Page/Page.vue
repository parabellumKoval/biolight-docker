<template>
<div>
	<div class="article">
		<div class="article__img" v-if="page.image">
			<nuxt-picture :src="page.image" sizes="sm:100vw lg:1300px" quality="70" format="webp" />
		</div>
		
		<BaseCategories />
		
		<div class="container">
			<div class="article__inner">
				<h1 class="title">{{ page.title }}</h1>
				
				<div class="article__content" v-html="page.content" ref="content"></div>
			</div>
		</div>
	</div>
	
	<BaseForm />
	
</div>
</template>
<script>
	import {imagePosition} from '@/mixins/imagePosition.js'
	
	export default {
		computed: {
			page() {
				return this.$store.state.page
			}
		},
    mixins: [imagePosition],
		updated (){
			this.imagePosition()
		},
		mounted() {
			this.imagePosition()
		}
	}
</script>

<style lang='scss' src='@/assets/scss/common/article.scss'></style>
<style lang='scss' src='@/assets/scss/pages/article.scss' scoped></style>
