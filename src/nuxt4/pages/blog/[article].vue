<template>
	<div class="container">
		<div class="article">
			<div class="article__img">
				<nuxt-picture :src="article.image" sizes="sm:100vw lg:1300px" quality="70" format="webp" />
			</div>
			<div class="article__inner">
				<h1 class="title">{{ article.name }}</h1>
				
				<div class="article__content" v-html="article.content">
				</div>
			</div>
			
			<template v-if="articles.data">
				<div class="articles-title">{{ $t('title.other_articles') }}</div>
				<div class="articles">
					<ArticleCard v-for="article in articles.data" :data="article" :key="article.id"/>
				</div>
			</template>
			
		</div>
	</div>
</template>

<script setup>
import { computed, ref, watch } from 'vue'

const route = useRoute()
const { $store } = useNuxtApp()

const article = ref({
  image: ''
})
const articles = ref({
  data: [],
  meta: {}
})

const loadArticle = async () => {
  const slug = route.params.article

  if (!slug) {
    article.value = {
      image: ''
    }
    articles.value = {
      data: [],
      meta: {}
    }
    return
  }

  const loadedArticle = await $store.dispatch('getArticle', slug)
  const response = await $store.dispatch('getArticles')

  article.value = { ...loadedArticle }
  articles.value = {
    ...response,
    data: (response?.data || []).filter((item) => item.id !== loadedArticle.id)
  }
}

await loadArticle()

watch([() => route.params.article, () => route.path], () => {
  loadArticle()
})

const seoTitle = computed(() => article.value?.seo?.meta_title || article.value?.title || '')
const seoDesc = computed(() => article.value?.seo?.meta_description || article.value?.seo?.meta_desc || '')

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

<style lang='scss' src='@/assets/scss/pages/article.scss' scoped></style>
