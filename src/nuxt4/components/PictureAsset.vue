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

const assetModules = import.meta.glob('../assets/**/*.{png,jpg,jpeg,webp,avif,gif,svg}', {
  eager: true,
  import: 'default'
})

const assetMap = Object.fromEntries(
  Object.entries(assetModules).map(([path, url]) => [path.replace('../assets', '/assets'), url])
)

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

const browserOrigin = computed(() => {
  const candidate = config.public?.browserOrigin || ''
  if (typeof candidate !== 'string' || !/^https?:\/\//.test(candidate)) return ''

  try {
    return new URL(candidate).origin
  } catch {
    return ''
  }
})

const apiOrigin = computed(() => {
  const candidate = config.public?.uploadsOrigin || config.apiBase || ''
  if (typeof candidate !== 'string' || !/^https?:\/\//.test(candidate)) return ''

  try {
    return new URL(candidate).origin
  } catch {
    return ''
  }
})

const normalizeSrc = (raw) => {
  const value = raw || ''
  if (!value) return ''

  if (/^https?:\/\//.test(value) || value.startsWith('data:')) return value

  const normalizedValue = value
    .replace(/^~\//, '/')
    .replace(/^assets\//, '/assets/')
    .replace(/^uploads\//, '/uploads/')

  if (browserOrigin.value && (normalizedValue.startsWith('/assets/') || normalizedValue.startsWith('/uploads/'))) {
    return `${browserOrigin.value}${normalizedValue}`
  }

  if (normalizedValue.startsWith('/assets/')) {
    return assetMap[normalizedValue] || normalizedValue
  }

  if (normalizedValue.startsWith('/uploads/')) {
    if (import.meta.server && apiOrigin.value) {
      return `${apiOrigin.value}${normalizedValue}`
    }

    return normalizedValue
  }

  if (normalizedValue.startsWith('/')) return normalizedValue
  return `/${normalizedValue}`
}

const resolvedSrc = computed(() => normalizeSrc(props.src))
const resolvedFallbackSrc = computed(() => normalizeSrc(props.fallbackSrc))
</script>
