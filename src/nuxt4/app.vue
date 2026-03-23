<template>
  <NuxtLayout>
    <NuxtPage :key="route.fullPath" />
  </NuxtLayout>
</template>

<script setup>
const route = useRoute()
const { $store } = useNuxtApp()
const { locale } = useI18n()

const i18nHead = useLocaleHead()

useHead(() => ({
  htmlAttrs: i18nHead.value.htmlAttrs || {},
  meta: i18nHead.value.meta || [],
  link: i18nHead.value.link || []
}))

const bootstrap = async () => {
  return Promise.all([
    $store.dispatch('getSettings'),
    $store.dispatch('getMenu'),
    $store.dispatch('getFooterMenu'),
    $store.dispatch('getCrossMenu')
  ])
}

await useAsyncData('biolight-bootstrap', bootstrap)

watch(locale, () => {
  bootstrap()
})
</script>
