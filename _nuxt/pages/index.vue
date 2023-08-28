<template>
  <div>
    <div class="flex">
      <div class="w-6/12">
        <div class="h-full flex flex-col items-start justify-center">
          <span
            class="font-black text-4xl bg-gradient-to-r from-yellow-200 to-yellow-100 bg-left-bottom bg-no-repeat transition-[background-size] duration-500 bg-[length:100%_12px]">
            우리의 PICK
          </span>
          <p class="font-medium mt-4">WEPICK은 설명이 가능하면 제작이 가능합니다.</p>
          <p class="mt-2">제작의 모든 과정을 처음부터 끝까지 책임지고 제작해 드립니다.</p>
          <div class="mt-8">
            <a class="relative inline-flex items-center gap-1 border border-black rounded-full bg-gradient-to-b from-yellow-200 to-yellow-300 px-6 py-3 drop-shadow-sm text-sm font-medium text-black"
              href="#contact">
              WEPICK 보러 가기
            </a>
          </div>
        </div>
      </div>
      <div class="w-6/12"><img src="~/assets/img/agency.svg"></div>
    </div>

    <div class="mt-[80px] relative flex flex-col items-center">
      <h1 class="text-center text-xl font-semibold tracking-tight dark:text-white lg:text-3xl lg:leading-snug">😻 WEPICK
        팀원 소개</h1>
      <div class="text-center">
        <p class="mt-2 text-sm">능력자들 모임 WEPICK 팀원을 소개합니다.</p>
      </div>

      <img alt="Thumbnail" class="rounded mt-4" src="~/assets/img/teamwork.jpg" />
    </div>

    <div class="mt-[80px] flex flex-col">
      <notice />
    </div>


    <div class="mt-[80px] flex flex-col">
      <portfolio />
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { useTestStore } from '../store/test'
import notice from '@/components/main/notice.vue'
import portfolio from '@/components/main/portfolio.vue'


export default {
  layout: (ctx) => ctx.$device.isDesktop ? 'home' : 'home.m',

  components: {
    notice,
    portfolio
  },
  computed: {
    ...mapState(useTestStore, ['count']),
    ...mapState(useTestStore, ['countState'])
  },
  methods: {
    ...mapActions(useTestStore, ['countPlus'])
  }
}
</script>