<template>
  <Modal :data="modalData" :is-visible="isVisible" @cancel="close">
    <div class="locales">
      <nuxt-link
        v-for="locale in availableLocales"
        :key="locale.code"
        :to="switchLocalePath(locale.code)"
        class="locales__item"
        @click="close()"
      >
        <span>{{ localeTitle(locale.code) }}</span>
      </nuxt-link>
    </div>
  </Modal>
</template>

<script>
export default {
  setup() {
    const { locales, t } = useI18n()
    const switchLocalePath = useSwitchLocalePath()

    return {
      availableLocales: locales,
      switchLocalePath,
      localeTitle: (code) => t(`language.${code}`)
    }
  },
  data() {
    return {
      show: true
    }
  },
  props: {
    isVisible: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    close() {
      this.$store.commit('close', 'lang')
    }
  },
  computed: {
    modalData() {
      return {
        title: this.$t('title.chose_lang')
      }
    }
  },
  watch: {
    isVisible: {
      immediate: true,
      handler(value) {
        this.show = value
      }
    }
  }
}
</script>

<style lang="scss" src="@/assets/scss/components/modal-lang.scss" scoped></style>
