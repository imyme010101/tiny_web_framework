<script setup>
import CircleButton from "./CircleButton.vue";

import CallWhiteSvg from "@/assets/svg/Call.svg";
import LoadSearchWhiteSvg from "@/assets/svg/LoadSearch.svg";
import MapAroundWhiteSvg from "@/assets/svg/MapAroundWhite.svg";
import PeepleWhiteSvg from "@/assets/svg/PeepleWhite.svg";
import { storeToRefs } from "pinia";
import { useStatusStore } from "@/stores/status";

const statusStore = useStatusStore()
const { wardIndex } = storeToRefs(statusStore);

</script>

<template>
  <div
    class="fixed bottom-0 right-0 z-[110] w-full flex flex-col items-end justify-between pointer-events-none p-1 transition-transform duration-500 transform-gpu"
    :class="{ 'transform-none': wardIndex, 'translate-y-[50%]': !wardIndex }"
  >
    <div class="flex flex-col items-end gap-4 mb-4">
      <CircleButton :size="{width: 50, height: 50}" :bg="`#fff`" :color="`#1C274C`" :text="`대상 추가`" :icon="`CircleAdd`" />
      <CircleButton :size="{width: 50, height: 50}" :bg="`#6b7280`" :color="`#1C274C`" :text="`장진수`" />
    </div>

    <div
      class="flex flex-col w-full bg-white pointer-events-auto border-[1px] border-gray-300 rounded-lg"
    >
      <div class="flex flex-col px-10 py-2">
        <span class="font-medium text-[#1C274C]">장진수</span>
        <span class="text-sm text-gray-500">경기도 안양시 동안구 관양2동 1494-7</span>
      </div>
      
      <div class="flex grid grid-cols-4 bg-[#04bba4] py-2 font-normal rounded-b">
        <button class="flex flex-col items-center justify-center text-white">
          <img :src="MapAroundWhiteSvg" width="25" height="25" />
          <div class="text-sm">거리뷰</div>
        </button>

        <button class="flex flex-col items-center justify-center text-white">
          <img :src="LoadSearchWhiteSvg" width="25" height="25" />
          <div class="text-sm">길안내</div>
        </button>

        <button class="flex flex-col items-center justify-center text-white">
          <img :src="CallWhiteSvg" width="25" height="25" />
          <div class="text-sm">전화걸기</div>
        </button>

        <button class="flex flex-col items-center justify-center text-white">
          <img :src="PeepleWhiteSvg" width="25" height="25" />
          <div class="text-sm">개인설정</div>
        </button>
      </div>
    </div>
  </div>
</template>