<template>
  <nav class="menu">
    <li class="menu__item" 
    		v-for="item in menu" 
    		:key="item.id" 
    		@click="openCategory(item)"
    		:class="{active: item.id === activeCategory}">
    		
      <nuxt-link :to="localePath(item.link)"
                 class="menu__link">
        {{ item.title }}

        <i v-if="item.children && item.children.length !== 0" class="icon-arrow icon-12"></i>
      </nuxt-link>

      <ul v-if="item.children && item.children.length !== 0" class="menu__drop">
	      <li v-for="subitem in item.children" :key="subitem.id || subitem.link">
	        <nuxt-link :to="localePath(subitem.link)" @click="close()" class="menu__sublink">
	          {{ subitem.title }}
	        </nuxt-link>
        </li>
      </ul>
    </li>
  </nav>
</template>

<script>

export default {
  setup() {
    const localePath = useLocalePath()
    return { localePath }
  },
  data() {
    return {
			activeCategory: null
    }
  },
  computed: {
    menu() {
      return this.$store.state.menu.data || []
    }
  },
  methods: {
	  openCategory(item) {
		  if(!item.children || !item.children.length)
		  	this.close()
		  
		  if(item.id === this.activeCategory)
		  	this.activeCategory = null
		  else
				this.activeCategory = item.id
	  },
	  close(){
		  this.activeCategory = null
		  this.$store.commit('close', 'menu')
	  }
  }
}
</script>


<style lang='scss' src='@/assets/scss/components/the-header-menu.scss' scoped></style>
