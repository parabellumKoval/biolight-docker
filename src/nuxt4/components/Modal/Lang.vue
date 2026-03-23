<template>
  <Modal :data="data" :is-visible="isVisible" @cancel="close">
  	<div class="locales">
	  	<nuxt-link v-for="locale in availableLocales"
							  :key="locale.code"
							  :to="switchLocalePath(locale.code)" 
							  class="locales__item"
							  @click="close()">
					<nuxt-picture :src="locale.icon" :alt="locale.name" width="24" height="24" />
        <span class="">{{ locale.name }}</span>
      </nuxt-link>
  	</div>
  </Modal>
</template>

<script>
  export default {
    setup() {
      const { locales } = useI18n()
      const switchLocalePath = useSwitchLocalePath()

      return {
        availableLocales: locales,
        switchLocalePath
      }
    },
    data() {
      return {
        show: true,
        data: {
	        title: ''
        }
      }
    },
    props: {
      isVisible: {
        type: Boolean,
        default: false
      }
    },
    methods: {
      close(){
	      this.$store.commit('close', 'lang')
      }
    },
    watch: {
      isVisible:{
	      immediate: true,
	      handler(value) {
	        this.show = value;
	      }
	    }
    },
    mounted() {
	    
      this.data = {
	      title: this.$t('title.chose_lang')
      }
    }
  }
</script>

<style lang='scss' src='@/assets/scss/components/modal-lang.scss' scoped></style>
