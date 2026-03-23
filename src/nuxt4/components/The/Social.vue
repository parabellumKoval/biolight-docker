<template>
	<div class="social" :class="{active: active}" @click="toggle()" v-click-outside="close">
		<div class="social__icon icon-22">
			<span class="icon-feedback"></span>
		</div>
		<div class="social__title">
			{{ $t('title.connect_us') }}:
		</div>
		<ul class="socials__items">
	      <li class="socials__item" v-if="$store.state.settings.telegram">
	        <nuxt-picture src="/assets/images/socials/tel.png" alt="Telegram" width="24" height="24" sizes="24px" quality="80" format="webp" />

        <a :href="$store.state.settings.telegram">
          <span class="underline">Мы в Telegram</span>
        </a>
      </li>

	      <li class="socials__item" v-if="$store.state.settings.viber">
	        <nuxt-picture src="/assets/images/socials/viber.png" alt="Viber" width="24" height="24" sizes="24px" quality="80" format="webp" />

        <a :href="$store.state.settings.viber">
          <span class="underline">Мы в Viber</span>
        </a>
      </li>

	      <li class="socials__item" v-if="$store.state.settings.whatsup">
	        <nuxt-picture src="/assets/images/socials/wat.png" alt="WhatsApp" width="24" height="24" sizes="24px" quality="80" format="webp" />

        <a :href="$store.state.settings.whatsup">
          <span class="underline">Мы в Whatsup</span>
        </a>
      </li>
	      <li class="socials__item">
	        <nuxt-picture src="/assets/images/socials/gmail.png" alt="Email" width="24" height="24" sizes="24px" quality="80" format="webp" />
					<a class="unselectable wp underline" :href="'mailto:' + $store.state.settings.email">
						{{ $store.state.settings.email }}
					</a>
	      </li>
    </ul>
	</div>
</template>
<script>

export default {
  data() {
    return {
	    active: false
    }
  },
  methods: {
	  toggle() {
			this.active = !this.active
	  },
	  close() {
			this.active = false
	  }
  }
}
</script>

<style lang='scss' src='@/assets/scss/components/the-social.scss' scoped></style>
