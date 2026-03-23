<template>
  <NuxtImg
    v-if="resolvedSrc"
    :src="resolvedSrc"
    :alt="alt"
    :sizes="sizes || undefined"
    :quality="quality || undefined"
    :format="format || undefined"
    v-bind="attrs"
  />
  <NuxtImg
    v-else-if="resolvedFallbackSrc"
    :src="resolvedFallbackSrc"
    :alt="alt"
    :sizes="sizes || undefined"
    :quality="quality || undefined"
    :format="format || undefined"
    v-bind="attrs"
  />
</template>

<script setup>
import { computed, useAttrs } from 'vue'

defineOptions({ inheritAttrs: false })

const props = defineProps({
  alt: {
    type: String,
    default: ''
  },
  fallbackSrc: {
    type: String,
    default: '/assets/images/item.png'
  },
  format: {
    type: String,
    default: ''
  },
  quality: {
    type: [String, Number],
    default: ''
  },
  sizes: {
    type: String,
    default: ''
  },
  src: {
    type: String,
    default: ''
  }
})

const attrs = useAttrs()
const config = useRuntimeConfig()

const apiOrigin = computed(() => {
  const candidate = config.public?.uploadsOrigin || config.apiBase || ''
  if (typeof candidate !== 'string' || !/^https?:\/\//.test(candidate)) return ''
  try {
    // `uploadsOrigin` might already be an origin; `apiBase` might include a path.
    return new URL(candidate).origin
  } catch {
    return ''
  }
})

const normalizeSrc = (raw) => {
  const value = raw || ''
  if (!value) return ''

  if (/^https?:\/\//.test(value) || value.startsWith('data:')) return value

  // Nuxt public assets.
  if (value.startsWith('/assets/') || value.startsWith('/uploads/')) {
    if (value.startsWith('/uploads/') && apiOrigin.value) {
      // Let IPX fetch from the internal API container and generate optimized variants.
      return `${apiOrigin.value}${value}`
    }
    return value
  }

  // Legacy patterns.
  if (value.startsWith('~/')) return `/${value.slice(2).replace(/^\/+/, '')}`
  if (value.startsWith('assets/')) return `/${value}`
  if (value.startsWith('uploads/') && apiOrigin.value) return `${apiOrigin.value}/${value}`

  if (value.startsWith('/')) return value
  return `/${value}`
}

const resolvedSrc = computed(() => normalizeSrc(props.src))
const resolvedFallbackSrc = computed(() => normalizeSrc(props.fallbackSrc))
</script>
