<template>
	<div class="product">
		<div class="product__img">
			<PictureAsset
        :src="resolvedImage"
        :alt="data.name || ''"
        sizes="sm:100vw lg:290px"
        provider="ipx"
      />
		</div>
		<nuxt-link :to="localePath(data.link)" class="product__name">{{ data.name }}</nuxt-link>
		
		<div class="product__box">
			<div class="product__price">
				<template v-if="data.price">
				{{ data.price }} грн.
				</template>
			</div>	
			<button class="btn btn-primary" @click="openOrderModal(data.name)">
				<span class="icon-cart icon-20"></span>
				{{ $t('btn.order') }}
			</button>
		</div>
	</div>
</template>
<script>
	import { normalizeImageSrc } from '@/utils/normalize-image-src'

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
						name: '',
						price: ''
					}
				}
			}
		},
		computed: {
			resolvedImage() {
				return normalizeImageSrc(this.data?.image)
			}
		},
		methods: {
		  openOrderModal(productName){
			  this.$store.commit('setOrder', {name: productName})
			  this.$store.commit('show', 'order')
		  },
		}
	}
</script>
<style lang='scss'>
	.product__img {
		img {
	    width: 100%;
			height: 100%;
	    object-fit: cover;
	    object-position: center;
		}
	}
</style>
<style lang='scss' src='@/assets/scss/components/product-card.scss' scoped></style>
