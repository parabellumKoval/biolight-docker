<template>
	<div class="header__wrapper">
	  <header class="header" :class="{active: $store.state.menu.isShow}">
	    <div class="container">
	      <div class="header__inner" >
	        <nuxt-link :to="localePath('/')" class="header__logo">
	          <nuxt-picture :src="logoSrc" sizes="sm:100px md:156px lg:230px" format="webp" />
	        </nuxt-link>
	        
	        <button class="menu-btn-mobile" @click="openMenu()" :class="{active: $store.state.menu.isShow}">
		        <span></span>
		        {{ $t('btn.menu') }}
	        </button>
	        
	        <div class="header__box" :class="{active: $store.state.menu.isShow}">
		        <TheHeaderMenu />
						
						<div class="header__box-lc">
			        <button @click="openLangModal()"  class="header__lang">
			          <span class="icon-language icon-22"></span>
			          <span class="">{{ lang.title }}</span>
			        </button>
			
			        <div class="header__contacts">
			          <a :href="'tel:'+ phone.link">
			            {{ phone.title }}
			          </a>
			
			          <button
				          	@click="openContactsModal()"
			              class="header__contact">
			            {{ $t('btn.all_contacts') }}
			
			            <span class="icon-arrow icon-10"></span>
			          </button>
			        </div>
		        </div>
	        </div>
	      </div>
	    </div>
	  </header>
	  
		<transition name="moveup">
	  	<TheHeaderBreadcrumbs  v-if="isBreadcrumbsShow"/>
	  </transition>
	  
  </div>
</template>

<script>
import logoSrc from '@/assets/icons/logo2.png'

export default {
  setup() {
    const localePath = useLocalePath()
    return { localePath }
  },
  data() {
    return {
      logoSrc,
      lang: {
        title: 'рус',
        img: '/assets/icons/ru.svg'
      }
    }
  },
  methods: {
	  openLangModal(){
		  this.$store.commit('show', 'lang')
	  },
	  openContactsModal(){
		  this.$store.commit('show', 'contacts')
	  },
	  openMenu() {
		  this.$store.commit('toggle', 'menu')
	  }
  },
  watch: {
	  '$i18n.locale': {
		  immediate: true,
		  handler(v) {
			  this.lang.title = this.$i18n.localeProperties.shortName
			  this.lang.img = this.$i18n.localeProperties.icon
		  }
	  }
  },
  computed: {
    phone() {
      return {
        title: this.$store.state.settings.phone,
        link: this.$store.state.settings.phone
      }
    },
	  isBreadcrumbsShow(){
			const path = (this.$route && this.$route.path ? this.$route.path : '').replace(/\/$/, '')
			return !['', '/', '/ru', '/uk', '/en'].includes(path)
		},
  }
}
</script>

<style lang='scss' src='@/assets/scss/components/the-header.scss' scoped></style>
