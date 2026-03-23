<template>
  <Modal :data="data" :is-visible="isVisible" @cancel="close">  
    
    <div class="title" v-if="data.product_name">
      Товар “{{ data.product_name }}”
    </div>
    
  	<form class="form__group">
      <div class="form__inner">
        <div class="form__row">
          <label for="name" class="form__label" :class="{error: errors.name}">
            <input id="name" type="name" :placeholder="$t('form.name')" v-model="data.name">
            <span class="icon-user icon-30"></span>
          </label>

          <label for="email" class="form__label" :class="{error: errors.email}">
            <input id="email" type="email" :placeholder="$t('form.email')" v-model="data.email">
            <span class="icon-email icon-28"></span>
          </label>

          <label for="phone" class="form__label" :class="{error: errors.phone}">
            <input id="phone" type="phone" :placeholder="$t('form.phone')" v-model="data.phone">
            <span class="icon-phone icon-26"></span>
          </label>
        </div>

        <div class="form__row">
          <label for="comment" class="form__label form__label--comment" :class="{error: errors.text}">
            <textarea-autosize id="comment" type="text" :placeholder="$t('form.text')" v-model="data.text" :min-height="25" :rows="1" />
            <span class="icon-new-line icon-30"></span>
          </label>
        </div>

        <div class="form__bottom">
          <div class="form__meta">
            {{ $t('form.personal_data_text') }} <nuxt-link to="">{{ $t('form.personal_data') }}</nuxt-link>.
          </div>

          <button class="btn btn-primary" type="button" @click="send">
            {{ $t('btn.send_order') }}
          </button>
        </div>
      </div>
    </form>
  </Modal>
</template>

<script>
	
	import {form} from '@/mixins/form.js'

  export default {
    data() {
      return {
        show: true
      }
    },
    mixins: [form],
    props: {
      isVisible: {
        type: Boolean,
        default: false
      }
    },
    methods: {
      close(){
	      this.$store.commit('close', 'order')
      }
    },
    computed: {
		},
    watch: {
	    '$store.state.order.data.name': {
		    immediate: true,
		    deep:true,
		    handler(v) {
			    if(!v)
			    	return
			    	
			    this.data.product_name = v
		    }
	    },
      isVisible:{
	      immediate: true,
	      handler(value) {
	        this.show = value;
	      }
	    }
    },
    mounted() {
      this.data.title = this.$t('title.add_order')
    },
		unmounted() {
			  this.$store.commit('setOrder', {name: null})
		}
  }
</script>

<style lang='scss' src='@/assets/scss/components/modal-order.scss' scoped></style>
