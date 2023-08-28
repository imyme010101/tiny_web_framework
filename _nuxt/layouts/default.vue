
<template>
  <div class="flex flex-col min-h-screen bg-c-2">
    <header
      class="fixed w-full px-10 z-20 text-gray-100 transition-colors duration-100 ease-in-out bg-c-0"
    >

    </header>

    <div
      class="pt-20"
    >
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