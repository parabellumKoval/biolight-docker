export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.vueApp.directive('click-outside', {
    beforeMount(el, binding) {
      el.__clickOutsideHandler__ = (event) => {
        if (!(el === event.target || el.contains(event.target))) {
          if (typeof binding.value === 'function') {
            binding.value(event)
          }
        }
      }

      document.addEventListener('click', el.__clickOutsideHandler__)
    },
    unmounted(el) {
      document.removeEventListener('click', el.__clickOutsideHandler__)
      delete el.__clickOutsideHandler__
    }
  })
})
