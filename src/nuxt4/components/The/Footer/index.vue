<template>
  <footer class="footer">
    <div class="container">
      <div class="footer__top">
        <div class="footer__logo">
          <nuxt-link :to="localePath('/')">
            <nuxt-picture src="/assets/icons/logo.png" sizes="sm:100px md:156px lg:230px" format="webp" />
          </nuxt-link>

          <p class="footer__logo-desc">
<!-- 	          {{ $store.state.settings.desc }} -->
						{{ $t('footer.desc') }}
          </p>
        </div>

        <div class="footer__items">

          <div class="footer__row">
            <div class="footer__subtitle">
              {{ $t('title.work_time') }}
            </div>

<!--             <p class="footer__desc unselectable wp" v-html="$store.state.settings.time"></p> -->
            <p class="footer__desc unselectable wp">
	            
							{{ $t('footer.time_1') }}<br>
							{{ $t('footer.time_2') }}
            </p>
          </div>

          <div class="footer__row">
            <div class="footer__subtitle">
              {{ $t('title.phones') }}
            </div>

            <div class="footer__links">
              <a class="unselectable wp underline" :href="'tel:' + $store.state.settings.phone">
	              {{ $store.state.settings.phone }}
	            </a>
              <a class="unselectable wp underline" :href="'tel:' + $store.state.settings.phone_2">
	              {{ $store.state.settings.phone_2 }}
	            </a>
            </div>
          </div>

          <div class="footer__row">
            <div class="footer__subtitle">
              {{ $t('title.address') }}
            </div>

            <a class="address unselectable"
               href="https://www.google.com/maps/place/%D1%83%D0%BB.+%D0%91%D0%B0%D1%80%D1%80%D0%B8%D0%BA%D0%B0%D0%B4%D0%BD%D0%B0%D1%8F,+2%D0%9A,+%D0%94%D0%BD%D0%B8%D0%BF%D1%80%D0%BE,+%D0%94%D0%BD%D0%B5%D0%BF%D1%80%D0%BE%D0%BF%D0%B5%D1%82%D1%80%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C,+49000/data=!4m2!3m1!1s0x40dbe2dc898ac0c1:0x840bfde48abe402c?sa=X&ved=2ahUKEwjMx9rJmLH0AhXhQeUKHdHPAvwQ8gF6BAgTEAE">
<!-- 	               {{ $store.state.settings.address }} -->
								{{ $t('footer.address') }}
            </a>
          </div>

        </div>
      </div>

      <div class="footer__bottom">
        <div>
          {{ $t('title.guard_1') }} 
          <a class="underline unselectable wp" href="#">{{ $t('title.guard_2') }} </a> {{ $t('title.and') }}  
          <a class="underline unselectable wp" href="#">{{ $t('title.guard_3') }} </a>.
        </div>

<!--         <a class="underline unselectable wp" href="https://aimix.space/ru">{{ $t('footer.developer') }} <span>AIMIX.SPACE</span></a> -->
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  setup() {
    const localePath = useLocalePath()
    return { localePath }
  }
}
</script>
<style>

</style>
<style lang='scss' src='@/assets/scss/components/the-footer.scss' scoped></style>
