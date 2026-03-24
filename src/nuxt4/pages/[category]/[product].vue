<template>
	<div class="container">
		
		<h1 class="title">{{ product.name }}</h1> 
		
		<div class="product">
			<div class="product__left">
				<div class="product__slider">
					<div class="product__img">
						<transition name="fade">
							<PictureAsset
                v-if="currentImgSrc"
                :src="currentImgSrc"
                :alt="product.name || ''"
                sizes="sm:100vw lg:520px"
                provider="ipx"
              />
						</transition>
					</div>
					<div class="product__slider-images" v-if="productImages.length > 1">
						<div class="product__slider-image" 
									v-for="(productImage, index) in productImages" 
									:class="{active: checkImage(index)}"
									@click="setImage(index)">
							<PictureAsset
                :src="productImage"
                :alt="product.name || ''"
                sizes="sm:88px lg:88px"
                provider="ipx"
              />
						</div>
					</div>
				</div>
				
				<div class="product__content">
					<div class="product__tabs">
						<button	@click="tab.selected = 'description'"
										:class="{disabled: !product.description || !product.description.length, active: tab.selected === 'description'}">
										{{ $t('title.desc') }}
						</button>
						<button @click="tab.selected = 'ingredients'"
										:class="{disabled: !product.ingredients || !product.ingredients.length, active: tab.selected === 'ingredients'}">
										{{ $t('title.ingredients') }}
						</button>
					</div>
					<div class="product__texts" v-html="product[tab.selected]"></div>
				</div>
			</div>
			
			<div class="product__right">
				<h1 class="title">{{ product.name }}</h1> 
				<div class="product__category">
					{{ $t('title.product_category') }}: 
					<nuxt-link :to="localePath(product.category_link)" class="underline">{{ product.category_name }}</nuxt-link>
				</div>
				<div class="product__code" v-if="product.code">{{ $t('title.product_code') }}: <b>{{ product.code }}</b></div>
				<div class="product__in-stock" v-if="product.in_stock">{{ $t('title.in_stock') }}</div>
				<div class="product__price" v-if="product.price">{{ product.price }} грн.</div>
				<button class="btn btn-primary uppercase" @click="openOrderModal(product.name)">
					<span class="icon-cart icon-20"></span>
					{{ $t('btn.order') }}
				</button>
				
				<div class="product__content">
					<div class="product__tabs">
						<button
										:class="{disabled: !product.description || !product.description.length, active: tab.selected === 'description'}">
										{{ $t('title.desc') }}
						</button>
						<button :class="{disabled: !product.ingredients || !product.ingredients.length, active: tab.selected === 'ingredients'}">
										{{ $t('title.ingredients') }}
						</button>
					</div>
					<div class="product__texts" v-html="product[tab.selected]"></div>
				</div>
				
			</div>
		</div>
	</div>
</template>

<script setup>
import { computed, reactive, ref, watch } from 'vue'
import { normalizeImageSrc } from '@/utils/normalize-image-src'

const route = useRoute()
const { $store } = useNuxtApp()
const localePath = useLocalePath()

const tab = reactive({
  selected: 'description'
})
const image = reactive({
  selected: 0
})
const product = ref({})

const loadProduct = async () => {
  const slug = route.params.product

  if (!slug) {
    product.value = {}
    return
  }

  const response = await $store.dispatch('getProduct', slug)
  product.value = { ...response }
  tab.selected = 'description'
  image.selected = 0
}

await loadProduct()

watch([() => route.params.product, () => route.path], () => {
  loadProduct()
})

const currentImg = computed(() => product.value?.images?.[image.selected])
const currentImgSrc = computed(() => normalizeImageSrc(currentImg.value))
const productImages = computed(() => (product.value?.images || []).map((value) => normalizeImageSrc(value)))
const seoTitle = computed(() => product.value?.seo?.meta_title || product.value?.name || '')
const seoDesc = computed(() => product.value?.seo?.meta_description || '')

const openOrderModal = (productName) => {
  $store.commit('setOrder', { name: productName })
  $store.commit('show', 'order')
}

const setImage = (value) => {
  image.selected = value
}

const checkImage = (value) => value === image.selected

useHead(() => ({
  title: seoTitle.value,
  meta: [
    {
      name: 'description',
      content: seoDesc.value
    }
  ]
}))
</script>

<style lang='scss' src='@/assets/scss/pages/catalog/product.scss' scoped></style>
