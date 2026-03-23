<template>
	<div class="links" v-if="menu && menu.length">
		<div class="container links-wrapper">
			
			<div class="links-box" v-for="item in menu" :key="item.id || item.link">
				<div class="links-title">{{ item.title }}</div>
				<ul v-if="item.children && item.children.length">
					<li v-for="sub in item.children" :key="sub.id || sub.link">
						<nuxt-link :to="localePath(sub.link)"><span class="icon-arrow"></span>{{ sub.title }}</nuxt-link>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
</template>
<script>
	export default {
		setup() {
			const localePath = useLocalePath()
			return { localePath }
		},
		data() {
			return {
			}
		},
	computed: {
		menu() {
			return this.$store.state.footerMenu.data;
		}
	}
	}
</script>
<style lang='scss' src='@/assets/scss/components/the-footer-links.scss' scoped></style>
