<template>
  <div class="container">
    <div class="pagination" v-if="!loading">
      
      <button class="btn btn-secondary" @click="changePage(meta.current_page + 1, true)" v-if="loadmore && meta.current_page !== meta.last_page" v-show="!disabled && meta.last_page > 1">
        {{ $t('btn.watch_more') }}
      </button>
      
      <div class="page-counter" v-show="!disabled && meta.last_page > 1" v-if="!hidePages">
        <div class="page-counter__inner" @click="loading? $event.preventDefault() : true">
          <i class="page-counter__prev icon-arrow icon-12" @click="changePage(meta.current_page - 1)" v-show="meta.current_page > 1"></i>
          <ul class="page-counter__list">
            <li :class="{'active': meta.current_page == 1}" @click="changePage(1)">1</li>
            <li class="meta" v-if="meta.current_page > 3 && meta.last_page > 4">...</li>

            <template v-if="meta.current_page == 1">
              <li :class="{'active': meta.current_page == 2}" @click="changePage(2)" v-if="meta.last_page > 2">2</li>
              <li :class="{'active': meta.current_page == 3}" @click="changePage(3)" v-if="meta.last_page > 3">3</li>
            </template>
            
            <template v-else-if="meta.current_page == meta.last_page">
              <li :class="{'active': meta.current_page == meta.last_page - 2}" @click="changePage(meta.last_page - 2)" v-if="meta.last_page > 3">{{meta.last_page - 2}}</li>
              <li :class="{'active': meta.current_page == meta.last_page - 1}" @click="changePage(meta.last_page - 1)" v-if="meta.last_page > 2">{{ meta.last_page - 1 }}</li>
            </template>

            <template v-else>
              <li @click="changePage(meta.current_page - 1)" v-if="meta.last_page > 3 && meta.current_page > 2">{{ meta.current_page - 1 }}</li>
              <li class="active" v-if="meta.last_page > 2">{{ meta.current_page }}</li>
              <li @click="changePage(meta.current_page + 1)" v-if="meta.last_page > 3 && meta.current_page < meta.last_page - 1">{{ meta.current_page + 1 }}</li>
            </template>
            
            <li class="meta" v-if="meta.current_page < meta.last_page - 2 && meta.last_page > 4">...</li>

            <li :class="{'active': meta.current_page == meta.last_page}" @click="changePage(meta.last_page)">{{ meta.last_page }}</li>
          </ul>
          <i class="icon-arrow icon-12 page-counter__next" @click="changePage(meta.current_page + 1)" v-show="meta.current_page < meta.last_page"></i>
        </div>
      </div>
    </div>
    
    <div v-else class="preload__wrapper">
	    <span class="preload"></span>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        meta: {
          current_page: 1,
          last_page: 1
        },
        disabled: false,
      }
    },

    props: {
      dataMeta: {
        type: Object,
        default: null
      },
      loading: {
        type: Boolean,
        required: true
      },
      loadmore: {
        type: Boolean,
        default: true
      },
      perPage: {
        type: Number,
        default: null
      },
      data: {
        type: Array,
        default: null
      },
      hidePages: {
        type: Boolean,
        default: false    
      }
      
    },

    computed: {
      isClientSide() {
        /** if it`s not server pagination we create it on client */
        return this.data && this.perPage;
      }
    },

    methods: {
      changePage(page, append = false) {
        if (this.isClientSide) {
          this.meta.current_page = page;
          return;
        }
        if (!this.disabled) {
          this.$emit('changePage', {page: page, append: append});
        }
      },

      paginate() {
        const currPage = this.meta.current_page;
        const from = this.perPage * (currPage - 1);
        const to = this.perPage * currPage;
        const paginatedData = this.data.slice(from, to);
        this.$emit("getPaginatedData", paginatedData);
      }
    },

    watch: {
      data(data) {
        if (this.isClientSide) {
          this.meta.current_page = 1;
          this.meta.last_page = Math.ceil(data.length / this.perPage);
          this.paginate();
        }
      },
      dataMeta: {
        handler(value) {
          if (value) {
            this.meta = value;
          }
        }
      },
      loading: {
        handler(value) {
          this.disabled = value;
        }
      },
      "meta.current_page": {
        deep: true,
        handler() {
          if (this.isClientSide) {
            this.paginate();
          }
        }
      }
    },

    mounted() {
      if (this.dataMeta) {
        this.meta = this.dataMeta;
      }
      this.disabled = this.loading;

      if (this.isClientSide) {
        this.meta.last_page = Math.ceil(this.data.length / this.perPage);
        this.paginate();
      }
    }
  }
</script>

<style lang="scss" src="@/assets/scss/components/pagination.scss" scoped></style>