<template>
  <div class="socials" >
    <div class="container">
      <ul class="socials__items">
	        <li class="socials__item">
	          <PictureAsset src="/assets/images/socials/tel.png" alt="Telegram" width="24" height="24" sizes="24px" quality="80" format="webp" />

          <nuxt-link :to="localePath('/')">
            <span class="underline">Telegram</span>
          </nuxt-link>
        </li>

	        <li class="socials__item">
	          <PictureAsset src="/assets/images/socials/viber.png" alt="Viber" width="24" height="24" sizes="24px" quality="80" format="webp" />

          <nuxt-link :to="localePath('/')">
            <span class="underline">Viber</span>
          </nuxt-link>
        </li>

	        <li class="socials__item">
	          <PictureAsset src="/assets/images/socials/wat.png" alt="WhatsApp" width="24" height="24" sizes="24px" quality="80" format="webp" />

          <nuxt-link :to="localePath('/')">
            <span class="underline">WhatsApp</span>
          </nuxt-link>
        </li>
        <li class="socials__item">

	          <PictureAsset src="/assets/images/socials/gmail.png" alt="Email" width="24" height="24" sizes="24px" quality="80" format="webp" />

          <div class="socials__gmail">
            <nuxt-link :to="localePath('/')">
              <span class="underline">Email</span>
            </nuxt-link>
            <a class="unselectable wp underline" href="mailto:office@biolight.com.ua">office@biolight.com.ua</a>
          </div>

        </li>
      </ul>
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
}
</script>

<style lang='scss' src='@/assets/scss/components/base-social.scss' scoped></style>
