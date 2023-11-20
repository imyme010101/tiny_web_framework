<template>
<div class="flex items-center justify-center gap-1">
  <label v-if="icon" class="text-xxs bg-[#1c274c] text-white rounded-full px-3 py-1">{{ text }}</label>
  <div
    class="relative rounded-full drop-shadow-xl pointer-events-auto"
    :style="[`width: ${width}px`, `height: ${height}px`, `background: #f5f5f5`]"
  >
    <div
      class="absolute top-0 left-0 rounded-full"
      :style="[`top: ${(height - (height/1.2))/2}px`, `left: ${(width - (width/1.2))/2}px`, `width: ${width/1.2}px`, `height: ${height/1.2}px`, `background: ${bg}`]"
    >
    </div>
    <!-- <img :src="icon" alt="icon" style="position: absolute; top: 20%; left: 20%; width: 60%; height: 60%; z-index: 11" class="pulse-me" /> -->
  
    <div class="absolute top-0 inset-x-0 inset-y-0 flex items-center justify-center z-[12]">
      <div v-if="!icon" class="flex items-center justify-center" :style="[`color: ${color}`]">
        <svg width="24" height="30" viewBox="0 0 28 34"  fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M23.6901 23.4853C21.5057 23.1223 18.5237 21.1171 18.5287 20.2544L18.5414 18.0745C18.5462 17.2617 19.7294 15.7473 20.2372 14.349C20.285 14.2172 20.5852 14.3711 20.8797 14.0385C21.4342 13.4052 21.5211 12.4388 21.6496 11.9992C21.8544 11.3078 20.9577 11.2745 20.9577 11.2745C20.9577 11.2745 21.6473 7.64332 21.067 5.34388C20.2824 2.21255 15.9699 0.611996 14.2788 0.602139C12.5855 0.592269 8.26108 2.14248 7.43578 5.26442C6.82877 7.55694 7.49085 11.196 7.49085 11.196C7.49085 11.196 6.62594 11.2191 6.82046 11.9128C6.94607 12.354 7.08133 13.3215 7.63271 13.9613C7.92115 14.2972 8.09709 14.1462 8.14333 14.2786C8.63477 15.6827 9.80031 17.2107 9.79557 18.0235L9.78287 20.2034C9.77784 21.0661 6.77052 23.0364 4.58201 23.3739C1.77157 23.8059 0.373099 25.6173 1.00423 30.1591C1.31981 32.427 7.69424 33.439 14.015 33.3918C20.3347 33.5127 26.8166 32.5756 27.1586 30.3115C27.8448 25.7775 26.4975 23.95 23.6901 23.4853Z" fill="#9ca3af"/>
        </svg>
        <span style="position:absolute; top:50%; transform: translateY(-50%); margin: 0 auto; font-size: 12px; color: #fff;">{{text}}</span>
      </div>
      <span v-else class="m-auto text-white" :style="[`color: ${color}`]">
        <img :src="icon" alt="icon" style="position: absolute; top: 20%; left: 20%; width: 60%; height: 60%; z-index: 11" class="pulse-me" />
      </span>
    </div>
  </div>
</div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
  size: {},
  color: String,
  bg: String,
  text: String,
  icon: String
});

const width = ref(props.size.width);
const height = ref(props.size.height);

const color = ref(props.color);
const bg = ref(props.bg);

const text = ref(props.text ? props.text : '');

const icon = props.icon ? new URL(`/src/assets/svg/${props.icon}.svg`, import.meta.url).href : null
console.log(icon)
</script>