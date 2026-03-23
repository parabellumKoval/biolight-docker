<template>
	<div class="cats">
		<div class="container cats__wrapper">
			
			<nuxt-link :to="localePath(item.link)" class="cats__item" v-for="item in menu" :key="item.id || item.link">
				<span class="icon" :class="icons[item.id]"></span>
				<span class="cats__title">{{ item.title }}</span>
			</nuxt-link>	
				
<!--
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-pharmacy"></span>
				<span class="cats__title">Производство бадов</span>
			</nuxt-link>	
						
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-scales"></span>
				<span class="cats__title">Фасовка таблеток и порошков</span>
			</nuxt-link>	
						
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-pharmacy"></span>
				<span class="cats__title">Производство бадов</span>
			</nuxt-link>	
						
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-pharmacy"></span>
				<span class="cats__title">Производство бадов</span>
			</nuxt-link>	
			
			
			
						
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-pharmacy"></span>
				<span class="cats__title">Производство бадов</span>
			</nuxt-link>	
						
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-pharmacy"></span>
				<span class="cats__title">Производство бадов</span>
			</nuxt-link>	
						
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-pharmacy"></span>
				<span class="cats__title">Разработка технической документации</span>
			</nuxt-link>	
						
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-pharmacy"></span>
				<span class="cats__title">Составление маршрутов движения</span>
			</nuxt-link>	
						
			<nuxt-link to="" class="cats__item">
				<span class="icon icon-pharmacy"></span>
				<span class="cats__title">Производство бадов</span>
			</nuxt-link>	
-->
					
		</div>
	</div>
</template>
<script>
export default {
	setup() {
		const localePath = useLocalePath()
		return { localePath }
	},
	data(){
		return {
			icons: {
				34: 'icon-pharmacy',
				35: 'icon-scales',
				36: 'icon-pill',
				37: 'icon-blister',
				38: 'icon-pills',
				39: 'icon-bottle',
				40: 'icon-dhis2',
				41: 'icon-roadmap',
				42: 'icon-virus-sanitizer',
				43: 'icon-microscope'
			}
		}
	},
	computed: {
		menu() {
			return this.$store.state.crossMenu.data;
		}
	}
}
</script>
<style lang='scss' src='@/assets/scss/components/base-categories.scss' scoped></style>
