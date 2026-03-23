<template>
  <div>
    <div class="contacts">
      <div class="container">

        <div class="title contacts__title">{{ page.title }}</div>

        <div class="contacts__inner">
          <div class="contacts__content">
            <div class="contacts__row">
              <div class="contacts__subtitle">
                {{ $t('title.phones') }}
              </div>

              <div class="contacts__links">
                <a class="unselectable wp underline" :href="'tel:' + $store.state.settings.phone">
	                {{ $store.state.settings.phone }}
	              </a>
                <a class="unselectable wp underline" :href="'tel:' + $store.state.settings.phone_2">
	                {{ $store.state.settings.phone_2 }}
	              </a>
              </div>
            </div>

            <div class="contacts__row">
              <div class="contacts__subtitle">
                {{ $t('title.email') }}
              </div>

              <a class="unselectable wp underline" :href="'mailto:' + $store.state.settings.email">
	              {{ $store.state.settings.email }}
              </a>
            </div>

            <div class="contacts__row">
              <div class="contacts__subtitle">
                {{ $t('title.work_time') }}
              </div>

              <p class="contacts__desc unselectable wp" v-html="$store.state.settings.time"></p>
            </div>

            <div class="contacts__row">
              <div class="contacts__subtitle">
                {{ $t('title.address') }}
              </div>

              <a class="address unselectable"
                 href="https://www.google.com/maps/place/%D1%83%D0%BB.+%D0%91%D0%B0%D1%80%D1%80%D0%B8%D0%BA%D0%B0%D0%B4%D0%BD%D0%B0%D1%8F,+2%D0%9A,+%D0%94%D0%BD%D0%B8%D0%BF%D1%80%D0%BE,+%D0%94%D0%BD%D0%B5%D0%BF%D1%80%D0%BE%D0%BF%D0%B5%D1%82%D1%80%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C,+49000/data=!4m2!3m1!1s0x40dbe2dc898ac0c1:0x840bfde48abe402c?sa=X&ved=2ahUKEwjMx9rJmLH0AhXhQeUKHdHPAvwQ8gF6BAgTEAE">
	                 {{ $store.state.settings.address }}
              </a>
            </div>

            <div class="contacts__row">
              <div class="contacts__subtitle">
                {{ $t('title.messangers') }}
              </div>

		          <a class="unselectable wp underline"
			          v-if="$store.state.settings.telegram"
			          :href="$store.state.settings.telegram">Telegram</a>
			          <template v-if="$store.state.settings.viber">,</template>
		          <a class="unselectable wp underline" 
			          	v-if="$store.state.settings.viber"
				          :href="$store.state.settings.viber">Viber</a>
				      <template v-if="$store.state.settings.whatsup">,</template>
		          <a class="unselectable wp underline" 
			          	v-if="$store.state.settings.whatsup"
				          :href="$store.state.settings.whatsup">Whatsup</a>
            </div>


          </div>

          <div class="contacts__map">
            <nuxt-picture
              src="/assets/images/map.png"
              alt="map"
              sizes="sm:100vw lg:560px"
              quality="80"
              format="webp"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const { $store } = useNuxtApp()

const { data: page } = await useAsyncData('contacts-page', async () => {
  const response = await $store.dispatch('getPage', 'contacts')
  return response
})

const seoTitle = computed(() => page.value?.seo?.meta_title || page.value?.name || page.value?.title || '')
const seoDesc = computed(() => page.value?.seo?.meta_description || '')

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


<style lang='scss' src='@/assets/scss/pages/contacts.scss' scoped></style>
