<template>
  <div>
    <div class="advantages">
				<section>
					<div class="container">
				  	<div class="title">{{ page.name }}</div>
				  	<div class="adv">
					  	<div class="adv__item">
						  	<div class="adv__title">
									<span class="icon-team"></span>
									{{ ex['section_8_title-1'] }}
								</div>
						  	<div v-html="ex['section_8_text-1']"></div>
					  	</div>
					  	<div class="adv__item">
						  	<div class="adv__title">
									<span class="icon-tablets"></span>
									{{ ex['section_8_title-2'] }}
								</div>
						  	<div v-html="ex['section_8_text-2']"></div>
					  	</div>
					  	<div class="adv__item">
						  	<div class="adv__title">
									<span class="icon-shield"></span>
									{{ ex['section_8_title-3'] }}
								</div>
						  	<div v-html="ex['section_8_text-3']"></div>
					  	</div>
				  	</div>
				  </div>
				</section>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const { $store } = useNuxtApp()

const { data: page } = await useAsyncData('advantages-page', async () => {
  const response = await $store.dispatch('getPage', 'nashi-preimushhestva')
  return response
})

const seoTitle = computed(() => page.value?.seo?.meta_title || page.value?.name || page.value?.title || '')
const seoDesc = computed(() => page.value?.seo?.meta_description || '')
const ex = computed(() => page.value?.extras || {})

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

<style lang="scss">
@import '@/assets/scss/pages/home.scss';

.advantages {
	margin-bottom: 100px;
}
</style>
