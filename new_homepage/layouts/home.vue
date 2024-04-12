
<template>
  <div class="antialiased text-gray-800 dark:bg-black dark:text-gray-400">
    <div class="container px-8 mx-auto xl:px-5  max-w-screen-lg py-5 lg:py-8">
      <nav>
        <div class="flex flex-wrap justify-between md:flex-nowrap md:gap-10">
          <div class="order-1 hidden w-full flex-col items-end justify-start md:order-none md:flex md:w-auto md:flex-1 md:flex-row md:justify-end">
            <a class="px-5 py-2 text-sm font-semibold text-gray-600 hover:text-yellow-300 dark:text-gray-400" target="" rel="" href="/">
              <span>WEPICK?</span>
            </a>
            <a class="px-5 py-2 text-sm font-semibold text-gray-600 hover:text-yellow-300 dark:text-gray-400" target="_blank" rel="noopener" href="">
              <span>팀원</span>
            </a>
          </div>
          <div class="flex w-full items-center justify-between md:w-auto">
            <a class="flex-1 text-6xl font-black px-6 text-yellow-300" href="/">
              WE<span class="text-black">PICK</span>
            </a>
          </div>
          <div class="order-2 hidden w-full flex-col items-end justify-start md:order-none md:flex md:w-auto md:flex-1 md:flex-row">
            <a class="px-5 py-2 text-sm font-semibold text-gray-600 hover:text-yellow-300 dark:text-gray-400" target="" rel="" href="/">
              <span>소식</span>
            </a>
            <a class="px-5 py-2 text-sm font-semibold text-gray-600 hover:text-yellow-300 dark:text-gray-400" target="_blank" rel="noopener" href="">
              <span>포토폴리오</span>
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div class="container px-8 mx-auto xl:px-5  max-w-screen-lg py-5 lg:py-8">
      <nuxt />
    </div>
  </div>
</template>


<script>

export default {
  components: {
  },

  data() {
    return {
      
    }
  },

  computed: {
  },
  
  beforeMount() {
  },

  methods: {
  }
  // async asyncData({ store, params }) {
  //   await store.dispatch('settings/updateSettings', { name: 'region', value: params.region.toLowerCase() })
  // }
}
</script>