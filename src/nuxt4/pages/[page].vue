<template>
	<div>
		<Page v-if="page && page.type === 'page'" />
		<PageServise v-else-if="page && page.type === 'service'" />
		<PageCategory v-else-if="page && page.type === 'category'" />
	</div>
</template>

<script setup>
import { computed, ref, watch } from 'vue'

const route = useRoute()
const { locale } = useI18n()
const { $store } = useNuxtApp()

const page = ref({})

const loadPage = async () => {
  const slug = route.params.page

  if (!slug) {
    page.value = {}
    return
  }

  const response = await $store.dispatch('getPage', slug)
  page.value = response || {}

  if (response?.type === 'category') {
    const query = new URLSearchParams({
      per_page: 12,
      category_slug: slug
    }).toString()

    await $store.dispatch('getProducts', query)
  } else {
    $store.commit('setProducts', {
      data: [],
      meta: {}
    })
  }
}

await loadPage()

watch([() => route.params.page, () => locale.value], () => {
  loadPage()
})

const seoTitle = computed(() => page.value?.seo?.meta_title || page.value?.name || page.value?.title || '')
const seoDesc = computed(() => page.value?.seo?.meta_description || page.value?.seo?.meta_desc || '')

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
