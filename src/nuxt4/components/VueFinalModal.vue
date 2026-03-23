<template>
  <Teleport to="body">
    <div v-if="open" class="vfm" @keydown.esc="close">
      <div class="vfm__backdrop" @click.self="close">
        <slot />
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, watch } from 'vue'

const props = defineProps({
  modelValue: {
    type: Boolean,
    default: false
  },
  transition: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['closed', 'update:modelValue'])

const open = computed(() => props.modelValue)

const close = () => {
  if (!props.modelValue) {
    return
  }

  emit('update:modelValue', false)
  emit('closed')
}

const onKeydown = (event) => {
  if (event.key === 'Escape' && props.modelValue) {
    close()
  }
}

watch(open, (value) => {
  if (!process.client) {
    return
  }

  document.body.classList.toggle('modal-open', value)
}, { immediate: true })

onMounted(() => {
  window.addEventListener('keydown', onKeydown)
})

onBeforeUnmount(() => {
  window.removeEventListener('keydown', onKeydown)
  if (process.client) {
    document.body.classList.remove('modal-open')
  }
})
</script>
