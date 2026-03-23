<template>
	<div class="container">
		<div class="blog">
			<h1 class="title">{{ page.name }}</h1>
			
			<div class="articles">
				<ArticleCard v-for="article in articles.data" :data="article" :key="article.id"/>
			</div>
			
			<BasePagination :loading="false" :data-meta="articles.meta" hide-pages/>
			
		</div>
	</div>
</template>
<script setup>

const { $store } = useNuxtApp()

const page = {
  name: 'Статьи'
}

const { data: articles } = await useAsyncData('blog-index', async () => {
  const response = await $store.dispatch('getArticles')
  return response
})

useHead(() => ({
  title: page.name
}))
</script>
<style lang='scss' src='@/assets/scss/pages/blog.scss' scoped></style>
