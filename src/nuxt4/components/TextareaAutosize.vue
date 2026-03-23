<template>
  <textarea
    ref="textarea"
    :value="modelValue"
    v-bind="attrs"
    @input="onInput"
  />
</template>

<script setup>
import { nextTick, onBeforeUnmount, onMounted, ref, useAttrs, watch } from 'vue'

defineOptions({ inheritAttrs: false })

const props = defineProps({
  minHeight: {
    type: [Number, String],
    default: 25
  },
  modelValue: {
    type: String,
    default: ''
  },
  rows: {
    type: [Number, String],
    default: 1
  }
})

const emit = defineEmits(['update:modelValue'])

const attrs = useAttrs()
const textarea = ref(null)

const resize = () => {
  if (!textarea.value) {
    return
  }

  textarea.value.style.height = 'auto'
  const minHeight = Number(props.minHeight) || 0
  const nextHeight = Math.max(textarea.value.scrollHeight, minHeight)
  textarea.value.style.height = `${nextHeight}px`
}

const onInput = (event) => {
  emit('update:modelValue', event.target.value)
  nextTick(resize)
}

onMounted(resize)

watch(() => props.modelValue, () => {
  nextTick(resize)
})

onBeforeUnmount(() => {
  textarea.value = null
})
</script>
