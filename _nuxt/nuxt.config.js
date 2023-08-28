require('dotenv').config()

export default {
  server: {
    host: '0.0.0.0',
    port: Number(process.env.PORT)
  },
  
  loading: {
    color: '#ff9600',
    height: '5px'
  },
  
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: '와홀덤 | 홀덤 매장 랭킹 사이트',
    htmlAttrs: {
      lang: 'kr'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'title', name: 'title', content: '' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' },
      
      { hid: 'og:title', name: 'og:title', content: '' },
      { hid: 'og:description', name: 'og:description', content: '' },
      
      { hid: 'og:locale', property: 'og:locale', content: 'ko_KR' },
      { hid: 'og:type', property: 'og:type', content: 'website' },
      { hid: 'og:site_name', property: 'og:site_name', content: process.env.SITE_NAME },
      { hid: 'og:url', property: 'og:url', content: process.env.SITE_URL },
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  
  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '@/assets/css/main.css'
  ],
  
  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '@plugins/fillters.js'
  ],
  
  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    '@nuxtjs/composition-api/module',
    '@pinia/nuxt',
    '@nuxtjs/device',
    '@nuxtjs/dotenv'
  ],

  build: {
    postcss: {
      postcssOptions: {
        plugins: {
          tailwindcss: {},
          autoprefixer: {},
        },
      },
    },

  },
  
  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios'
  ],
  
  axios: {
    // 모듈 설정
    baseURL: process.client ? process.env.API_URL : process.env.LOCAL_API_URL
  }
}