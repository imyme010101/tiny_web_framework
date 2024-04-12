<template>
  <div class="relative z-20">
    <header
      class="fixed w-full z-20 px-4 text-gray-100 transition-colors duration-100 ease-in-out bg-c-0"
    >
      
    </header>
    
    <div class="relative w-full bg-c-2 pt-40">
      <nuxt />
    </div>
  </div>
</template>

<script>

export default {
  components: {
    
  },

  computed: {
    title() {
      return '롤 전적 검색 ZEM.GG | 소환사 인분, 소환사 등급 확인'
    }
  },
  

  beforeMount() {
  },

  methods: {
  }
}
</script>
