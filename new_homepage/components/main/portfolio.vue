<script setup>
const props = defineProps(['items'])

const items = props.items
console.log(items)
</script>

<template>
  <div>
    <h1 class="text-center text-xl font-semibold tracking-tight dark:text-white lg:text-3xl lg:leading-snug">🤖 우픽이
      작업했어요!</h1>
    <div class="text-center">
      <p class="mt-2 text-sm">우픽 최고의 팀원들이 작업한 웹, 앱 이에요.</p>
    </div>
    <div class="mt-4 grid gap-10 md:grid-cols-2 lg:gap-10 xl:grid-cols-4">

      <div
        v-for="item in items"
        :key="item.id"
        class="
          group
          cursor-pointer
          p-2 bg-white rounded-xl transform transition-all hover:-translate-y-2 duration-300 shadow-lg hover:shadow-2xl
          flex flex-col
        "
      >
        <a class="relative rounded-md bg-gray-100 h-40" href="/">
          <img src="~/assets/img/p-1.jpg" class="w-full h-full rounded-md object-cover">
        </a>
        <div class="">
          <div>
            <div class="flex gap-3">
              <a href="">
                <span class="inline-block text-xs font-medium tracking-wider uppercase mt-5 text-blue-600">
                  휘트니스/건강
                </span>
                <span class="inline-block text-xs font-medium tracking-wider uppercase mt-5 text-purple-600">
                  웹
                </span>
                <span class="inline-block text-xs font-medium tracking-wider uppercase mt-5 text-purple-600">
                  앱
                </span>
                <span class="inline-block text-xs font-medium tracking-wider uppercase mt-5 text-green-600">
                  ios / android
                </span>
              </a>
            </div>
            <h2 class="text-lg font-semibold leading-snug tracking-tight mt-2 dark:text-white">
              <a href="/">
                <span
                  class="bg-gradient-to-r from-yellow-200 to-yellow-100 bg-[length:0px_10px] bg-left-bottom bg-no-repeat transition-[background-size] duration-500 hover:bg-[length:100%_3px] group-hover:bg-[length:100%_10px] dark:from-purple-800 dark:to-purple-900">
                  혈당과 혈압, 체중을 입력하여 스스로 건강을 관리할 수 있는 애플리케이션 (웰체크, 닥터다이어리와 유사) 인기 글
                </span>
              </a>
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-10 flex items-center justify-center">
      <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm">
        <button
          class="relative inline-flex items-center gap-1 rounded-md border border-gray-300 bg-white px-3 py-2 pr-4 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 disabled:pointer-events-none disabled:opacity-40 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300">
          <span>더보기</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true" class="h-3 w-3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
          </svg>
        </button>
      </nav>
    </div>
  </div>
</template>