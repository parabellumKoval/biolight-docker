<template>
  <div v-if="items.length" class="notifications">
    <transition-group :name="animationName" tag="div" class="notifications__list">
      <div
        v-for="item in items"
        :key="item.id"
        class="nt"
        :class="[classes, `nt--${item.type || 'info'}`]"
      >
        <div class="nt__body">
          <strong v-if="item.title" class="nt__title">{{ item.title }}</strong>
          <div v-if="item.text" class="nt__text">{{ item.text }}</div>
        </div>
        <button class="nt__close" type="button" @click="remove(item.id)">
          ×
        </button>
      </div>
    </transition-group>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  animationName: {
    type: String,
    default: 'v-fade-left'
  },
  classes: {
    type: String,
    default: ''
  },
  duration: {
    type: Number,
    default: 5000
  },
  group: {
    type: String,
    default: 'default'
  },
  speed: {
    type: Number,
    default: 300
  }
})

const notifications = useState('notifications', () => [])

const items = computed(() => notifications.value.filter((item) => item.group === props.group))

const remove = (id) => {
  notifications.value = notifications.value.filter((item) => item.id !== id)
}
</script>
