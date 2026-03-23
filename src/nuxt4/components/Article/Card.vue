<template>
	<div class="article article-card">
		<div class="article__img">
			<nuxt-picture :src="data.image" sizes="sm:100vw lg:396px" quality="70" format="webp" />
		</div>
		<nuxt-link :to="localePath('/blog/' + data.slug)" class="article__title">{{ data.name }}</nuxt-link>
		
		<div class="article__desc" v-html="data.desc">
		</div>
		
		<div class="btn-wrapper">
			<nuxt-link :to="localePath('/blog/' + data.slug)" class="btn btn-text">
				{{ $t('btn.read_more') }}
				<i class="icon-arrow" ></i>	
			</nuxt-link>
		</div>
	</div>
</template>
<script>
	export default {
		setup() {
			const localePath = useLocalePath()
			return { localePath }
		},
		data() {
			return {
				
			}
		},
		props: {
			data: {
				type: Object,
				required: true,
				default: () => {
					return {
						image: '',
						title: '',
						desc: ''
					}
				}
			}
		}
	}
</script>
<style lang='scss'>
	.article-card {
		img {
			width: 100%;
			height: 100%;
	    object-fit: cover;
	    object-position: center;
		}
	}
</style>
<style lang='scss' src='@/assets/scss/components/article-card.scss' scoped></style>
