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

  const normalizedValue = value
    .replace(/^~\//, '/')
    .replace(/^assets\//, '/assets/')
    .replace(/^uploads\//, '/uploads/')

  if (normalizedValue.startsWith('/assets/')) {
    return assetMap[normalizedValue] || normalizedValue
  }

  if (normalizedValue.startsWith('/uploads/')) {
    if (apiOrigin.value) {
      // Let IPX fetch from the internal API container and generate optimized variants.
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
