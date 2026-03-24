<template>
  <section class="manufacturing manufacturing--cards">
    <div class="container">
      <h2 class="title manufacturing__title">{{ t('page.index.manufacturing.bad.title') }}</h2>

      <div class="manufacturing__cards-grid">
        <article class="manufacturing__card manufacturing__card--1">
          <div class="manufacturing__card-image">
            <NuxtImg
              src="/assets/images/home/manufacturing/bad-custom.png"
              :alt="badItems[0]?.title || t('page.index.manufacturing.bad.title')"
              width="940"
              height="565"
              sizes="sm:100vw md:100vw lg:300px"
              format="webp"
              densities="x1 x2"
            />
          </div>

          <h3 class="manufacturing__card-title">{{ badItems[0]?.title }}</h3>

          <div class="manufacturing__card-text">
            <p v-for="(paragraph, index) in badItems[0]?.paragraphs || []" :key="index">
              {{ paragraph }}
            </p>
          </div>
        </article>

        <article class="manufacturing__card manufacturing__card--2">
          <div class="manufacturing__card-image">
            <NuxtImg
              src="/assets/images/home/manufacturing/bad-modern.webp"
              :alt="badItems[1]?.title || t('page.index.manufacturing.bad.title')"
              width="887"
              height="650"
              sizes="sm:100vw md:100vw lg:300px"
              format="webp"
              densities="x1 x2"
            />
          </div>

          <h3 class="manufacturing__card-title">{{ badItems[1]?.title }}</h3>

          <div class="manufacturing__card-text">
            <p v-for="(paragraph, index) in badItems[1]?.paragraphs || []" :key="index">
              {{ paragraph }}
            </p>
          </div>
        </article>

        <article class="manufacturing__card manufacturing__card--3">
          <div class="manufacturing__card-image">
            <NuxtImg
              src="/assets/images/home/manufacturing/bad-contract.jpg"
              :alt="badItems[2]?.title || t('page.index.manufacturing.bad.title')"
              width="600"
              height="427"
              sizes="sm:100vw md:100vw lg:300px"
              format="webp"
              densities="x1 x2"
            />
          </div>

          <h3 class="manufacturing__card-title">{{ badItems[2]?.title }}</h3>

          <div class="manufacturing__card-text">
            <p v-for="(paragraph, index) in badItems[2]?.paragraphs || []" :key="index">
              {{ paragraph }}
            </p>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'

const { t, tm, rt } = useI18n()

const badItems = computed(() =>
  (tm('page.index.manufacturing.bad.items') || []).map((item) => ({
    title: rt(item.title),
    paragraphs: (item.paragraphs || []).map((paragraph) => rt(paragraph))
  }))
)
</script>

<style lang="scss" src="@/assets/scss/components/home-manufacturing-block.scss"></style>
