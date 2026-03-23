<template>
  <vue-final-modal 
    v-model="show"
    @closed="cancel()"
    transition="moveup"
  >
  	<transition name="moveup">
  	<div class="modal">
      <div class="modal__inner">
        <button class="modal__close" @click="cancel()">
        	<span class="icon-close"></span>
        </button>
        <h2 class="modal__title" v-if="data.title">
          {{ data.title }}
        </h2>
        <div class="modal__content">
	      	<slot />  
        </div>
      </div>
    </div>
    </transition>
    
  </vue-final-modal>
</template>

<script>
  export default {
    emits: ['confirm', 'cancel'],
    data() {
      return {
        show: false,
      }
    },
    props: {
      isVisible: {
        type: Boolean,
        default: false
      },
      data: {
	      type: Object
      }
    },
    methods: {
      confirm() {
        this.$emit('confirm');
      },
      cancel() {
        this.$emit('cancel');
      }
    },
    watch: {
      isVisible(value) {
        this.show = value;
      }
    }
  }
</script>
<style lang='scss' src='@/assets/scss/components/modal.scss' scoped></style>
