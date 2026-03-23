<template>
	<div class="home"> 
		<section class="banner">
      <div class="banner__img">
<!--         <img v-lazy="'assets/images/banner.jpg'" alt="banner"> -->
				<nuxt-picture src="/assets/images/banner.jpg" sizes="md:100vw lg:1300px" quality="90" format="webp" />
      </div>
      
      <div class="banner__wrapper">
	      <div class="container banner__inner">
		      <ul>
			      <li>{{ $t('page.index.experienced_team') }}</li>
			      <li>{{ $t('page.index.quality_control') }}</li>
			      <li>{{ $t('page.index.modern_production') }}</li>
		      </ul>
		      
		      <nuxt-link class="btn btn-secondary" :to="localePath('/')">
		      	{{ $t('btn.catalog') }}
						<span class="icon-arrow-up-right"></span>
		      </nuxt-link>
	      </div>
      </div>
		</section>
		
		<section>
			<BaseCategories />
		</section>
		
		
    <section class="s0">
      <div class="container">
        <div class="title">
          {{ ex.section_1_title }}
        </div>
				
				<div class="desc" v-html="ex.section_1_text"></div>
      </div>
    </section>

     <section class="s1">
	  	<div class="container">
		  	<div class="title">{{ ex.section_2_title }}</div>
		  	<div class="desc">{{ ex.section_2_desc }}</div>
		  	
		  	<div class="s1-grid">
			  	<div class="s1__section-1">
					  <div class="s1__section__img">
					  	<nuxt-picture src="/assets/images/main/s1-1.jpg" sizes="sm:150px lg:300px" quality="30" format="webp" />
				  	</div>
				  	<div class="s1__section__title">
					  	{{ ex['section_2_title-1'] }}
				  	</div>
				  	<div class="s1__section__text" v-html="ex['section_2_text-1']"></div>
			  	</div>
			  	<div class="s1__section-2">
					  <div class="s1__section__img">
					  	<nuxt-picture src="/assets/images/main/s1-2.jpg" sizes="sm:150px lg:300px" quality="50" format="webp" />
				  	</div>
				  	<div class="s1__section__title">
					  	{{ ex['section_2_title-2'] }}
				  	</div>
				  	<div class="s1__section__text"  v-html="ex['section_2_text-2']"></div>				  	
			  	</div>
			  	<div class="s1__section-3">
					  <div class="s1__section__img">
					  	<nuxt-picture src="/assets/images/main/s1-3.jpg" sizes="sm:150px lg:300px" quality="30" format="webp" />
				  	</div>
				  	<div class="s1__section__title">
					  	{{ ex['section_2_title-3'] }}
				  	</div>
				  	<div class="s1__section__text"  v-html="ex['section_2_text-3']"></div>				  	
			  	</div>
		  	</div>
		  	
		  </div>
	  </section>
    
    <section class="s1-sub">
	    <div class="container">
		    <div class="s1-sub__inner">
			  	<div class="s1-sub__img">
				  	<nuxt-picture src="/assets/images/main/s1-sub.jpg" sizes="sm:1px lg:580px" quality="20" format="webp" />
			  	</div>
			    <div class="s1-sub__title">{{ ex.section_3_title }}</div>
			    <div class="s1-sub__text" v-html="ex.section_3_desc"></div>
				  <nuxt-link class="btn btn-secondary" :to="localePath('/fasovka-tabletok-i-poroshkov')">
				  	{{ $t('btn.learn_more') }}
						<span class="icon-arrow-up-right"></span>
				  </nuxt-link>
		    </div>
	    </div>
    </section>
    
    <section>
	  	<div class="container">
		  	<div class="title">{{ ex.section_4_title }}</div>
		  	<div class="service-block">
			  	<div class="service__img">
				  	<nuxt-picture src="/assets/images/main/service-2.jpg" sizes="sm:100vw lg:530px" quality="10" format="webp"  />
			  	</div>
			  	<div class="service__desc">
				  	{{ ex.section_4_desc }}
			  	</div>
			  	<div class="service__text" v-html="ex.section_4_text"></div>
				  <nuxt-link class="btn btn-secondary" :to="localePath('/usluga-razliva-napitkov-i-masel')">
				  	{{ $t('btn.learn_more') }}
						<span class="icon-arrow-up-right"></span>
				  </nuxt-link>
		  	</div>
		  </div>
	  </section>
	  
    <section>
	  	<div class="container">
		  	<div class="title">{{ ex.section_5_title }}</div>
		  	<div class="service-block">
			  	<div class="service__img">
				  	<nuxt-picture src="/assets/images/main/service-3.jpg" sizes="sm:100vw lg:530px" quality="30" format="webp"/>
			  	</div>
			  	<div class="service__desc">
				  	{{ ex.section_5_desc }}
			  	</div>
			  	<div class="service__text" v-html="ex.section_5_text"></div>
				  <nuxt-link class="btn btn-secondary" :to="localePath('/blestirovanie')">
				  	{{ $t('btn.learn_more') }}
						<span class="icon-arrow-up-right"></span>
				  </nuxt-link>
		  	</div>
		  </div>
	  </section>
	  
	  
    <section>
	  	<div class="container">
		  	<div class="title">{{ ex.section_6_title }}</div>
		  	<div class="service-block">
			  	<div class="service__img">
				  	<nuxt-picture src="/assets/images/main/service-4.jpg" sizes="sm:100vw lg:530px" quality="30" format="webp" />
			  	</div>
			  	<div class="service__desc">
				  	{{ ex.section_6_desc }}
			  	</div>
			  	<div class="service__text" v-html="ex.section_6_text"></div>
				  <nuxt-link class="btn btn-secondary" :to="localePath('/razrabotka-tehnicheskoy-dokkumentacii')">
				  	{{ $t('btn.learn_more') }}
						<span class="icon-arrow-up-right"></span>
				  </nuxt-link>
		  	</div>
		  </div>
	  </section>
	  
	  
    <section>
	  	<div class="container">
		  	<div class="title">{{ ex.section_7_title }}</div>
		  	<div class="service-block">
			  	<div class="service__img">
				  	<nuxt-picture src="/assets/images/main/service-5.jpg" sizes="sm:100vw lg:530px" quality="10" format="webp" />
			  	</div>
			  	<div class="service__desc">
				  	{{ ex.section_7_desc }}
			  	</div>
			  	<div class="service__text" v-html="ex.section_7_text"></div>
				  <nuxt-link class="btn btn-secondary" :to="localePath('/sostavlenie-marshrutov-dvizheniya-transporta')">
				  	{{ $t('btn.learn_more') }}
						<span class="icon-arrow-up-right"></span>
				  </nuxt-link>
		  	</div>
		  </div>
	  </section>
	  
	  <section>
			<div class="container">
		  	<div class="title">{{ ex.section_8_title }}</div>
		  	<div class="adv">
			  	<div class="adv__item">
				  	<div class="adv__title">
					  	<span class="icon-team"></span>
					  	{{ ex['section_8_title-1'] }}
					  </div>
				  	<div v-html="ex['section_8_text-1']"></div>
			  	</div>
			  	<div class="adv__item">
				  	<div class="adv__title">
					  	<span class="icon-tablets"></span>
					  	{{ ex['section_8_title-2'] }}
					  </div>
				  	<div v-html="ex['section_8_text-2']"></div>
			  	</div>
			  	<div class="adv__item">
				  	<div class="adv__title">
					  	<span class="icon-shield"></span>
					  	{{ ex['section_8_title-3'] }}
					  </div>
				  	<div v-html="ex['section_8_text-3']"></div>
			  	</div>
		  	</div>
		  </div>
		</section>
	  
    
    <BaseForm />
    
    
<!--     <BaseSocial /> -->
    
  </div>
</template>

<script setup>
import { computed } from 'vue'

const { $store } = useNuxtApp()
const localePath = useLocalePath()

const { data: page } = await useAsyncData('home-page', async () => {
  const response = await $store.dispatch('getPage', 'glavnaya')
  return response
})

const seoTitle = computed(() => page.value?.seo?.meta_title || page.value?.name || page.value?.title || '')
const seoDesc = computed(() => page.value?.seo?.meta_description || '')
const ex = computed(() => page.value?.extras || {})

useHead(() => ({
  title: seoTitle.value,
  meta: [
    {
      name: 'description',
      content: seoDesc.value
    }
  ]
}))
</script>

<style lang='scss' src='@/assets/scss/pages/home.scss'></style>
