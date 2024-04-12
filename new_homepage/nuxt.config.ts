// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  
  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  modules: [
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt'
  ],
  
  pinia: {
    storesDirs: ['./stores/**'],
  },
})
