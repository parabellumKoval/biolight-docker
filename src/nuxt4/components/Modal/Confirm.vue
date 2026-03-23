<template>
  <vue-final-modal 
    @keydown.esc="cancel()"
    v-model="show"
    @closed="cancel()"
    transition="moveup"
  >
    <div class="popup-main">
      <div class="popup-main__inner">
        <button 
          class="popup-main__close"
          @click="cancel()" 
        ></button>
        <h2
          class="popup-main__title"
          v-if='data.title'
        >
          {{ data.title }}
        </h2>
        <p class="popup-main__content popup-main__parag" v-html="data.text"></p>
        <div class="popup-main__footer">
          <div class="popup-main__double-btn-wrap">
            <button 
              class="popup-main__btn-1 secondary-btn"
              @click="cancel()"
            >
              {{ data.cancelBtn }}
            </button>
            <button 
              class="popup-main__btn-2 primary-btn"
              @click="confirm()"
            >
              {{ data.confirmBtn }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </vue-final-modal>
</template>

<script>
  export default {
    data() {
      return {
        show: true,
      }
    },
    props: {
      isVisible: {
        type: Boolean,
        default: false
      },
      data: {
        type: Object,
        required: true
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
