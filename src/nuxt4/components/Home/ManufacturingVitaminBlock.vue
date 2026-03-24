<template>
  <section class="manufacturing manufacturing--vitamin">
    <div class="container">
      <div class="manufacturing__vitamin">
        <h2 class="title manufacturing__title">{{ t('page.index.manufacturing.vitamin.title') }}</h2>

        <div class="manufacturing__vitamin-stage">
          <div class="manufacturing__vitamin-media">
            <NuxtImg
              src="/assets/images/home/manufacturing/vitamin-background.webp"
              :alt="t('page.index.manufacturing.vitamin.title')"
              width="1536"
              height="1024"
              sizes="sm:100vw md:720px lg:1160px xl:1300px"
              format="webp"
              densities="x1 x2"
            />
          </div>

          <div class="manufacturing__vitamin-points">
            <article
              v-for="(item, index) in vitaminHighlights.left"
              :key="`left-${index}`"
              :class="['manufacturing__vitamin-point', 'manufacturing__vitamin-point--left', `manufacturing__vitamin-point--left-${index + 1}`]"
            >
              <span class="manufacturing__vitamin-point-icon" aria-hidden="true">✓</span>

              <div class="manufacturing__vitamin-point-content">
                <h3 class="manufacturing__vitamin-point-title">{{ item.title }}</h3>
                <p class="manufacturing__vitamin-point-text">{{ item.text }}</p>
              </div>
            </article>

            <article
              v-for="(item, index) in vitaminHighlights.right"
              :key="`right-${index}`"
              :class="['manufacturing__vitamin-point', 'manufacturing__vitamin-point--right', `manufacturing__vitamin-point--right-${index + 1}`]"
            >
              <span class="manufacturing__vitamin-point-icon" aria-hidden="true">✓</span>

              <div class="manufacturing__vitamin-point-content">
                <h3 class="manufacturing__vitamin-point-title">{{ item.title }}</h3>
                <p class="manufacturing__vitamin-point-text">{{ item.text }}</p>
              </div>
            </article>
          </div>
        </div>

        <div class="manufacturing__vitamin-mobile-list">
          <article
            v-for="(item, index) in vitaminHighlights.mobile"
            :key="`mobile-${index}`"
            class="manufacturing__vitamin-mobile-item"
          >
            <span class="manufacturing__vitamin-point-icon" aria-hidden="true">✓</span>

            <div class="manufacturing__vitamin-point-content">
              <h3 class="manufacturing__vitamin-point-title">{{ item.title }}</h3>
              <p class="manufacturing__vitamin-point-text">{{ item.text }}</p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'

const { t, tm, rt } = useI18n()

const normalizeHighlights = (items = []) =>
  items.map((item) => ({
    title: rt(item.title),
    text: rt(item.text)
  }))

const vitaminHighlights = computed(() => {
  const highlights = tm('page.index.manufacturing.vitamin.highlights') || {}
  const left = normalizeHighlights(highlights.left || [])
  const right = normalizeHighlights(highlights.right || [])

  return {
    left,
    right,
    mobile: [...left, ...right]
  }
})
</script>

<style lang="scss" src="@/assets/scss/components/home-manufacturing-block.scss"></style>
