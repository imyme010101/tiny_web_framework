<template>
  <div
    class="relative rounded-full drop-shadow-xl pointer-events-auto"
    :style="[`width: ${width}px`, `height: ${height}px`, `background: #f5f5f5`]"
    @click="console.log('EEE')"
  >
    <div
      class="absolute top-0 left-0 rounded-full"
      :style="[`top: ${(height - (height/1.2))/2}px`, `left: ${(width - (width/1.2))/2}px`, `width: ${width/1.2}px`, `height: ${height/1.2}px`, `background: ${bg}`]"
    >
    </div>
    <!-- <img :src="icon" alt="icon" style="position: absolute; top: 20%; left: 20%; width: 60%; height: 60%; z-index: 11" class="pulse-me" /> -->
  
    <div class="absolute top-0 inset-x-0 inset-y-0 flex items-center justify-center text-xs font-black z-[12]">
      <span v-if="!icon" class="m-auto text-white" :style="[`color: ${color}`]">장진수</span>
      <span v-else class="m-auto text-white" :style="[`color: ${color}`]">
        <img :src="icon" alt="icon" style="position: absolute; top: 20%; left: 20%; width: 60%; height: 60%; z-index: 11" class="pulse-me" />
      </span>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
  size: {},
  color: String,
  bg: String,
  icon: String
});

const width = ref(props.size.width);
const height = ref(props.size.height);

const color = ref(props.color);
const bg = ref(props.bg);

const icon = props.icon ? new URL(`/src/assets/svg/${props.icon}.svg`, import.meta.url).href : null
console.log(icon)
</script>