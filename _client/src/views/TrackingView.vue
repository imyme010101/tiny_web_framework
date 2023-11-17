<script setup lang="ts">
import { ref } from 'vue';
import KakaoMap from '@/components/KakaoMap/KakaoMap.vue';
import KakaoCustomOverlay from '@/components/KakaoMap/KakaoCustomOverlay.vue';

import MarkerDefaultSvg from '@/assets/svg/MarkerDefault.svg';
import MarkerTrackingSvg from '@/assets/svg/MarkerTracking.svg';
</script>


<template>
  <div id="map">
    <KakaoMap :center="{ lat: 33.450701, lng: 126.570667 }" :level="2">
      <KakaoCustomOverlay :position="{ lat: 33.450701, lng: 126.570667 }">
          <div class="overlaybox marker-select"><img :src="MarkerTrackingSvg" alt="" style="width: 100%; height: auto" /></div>
      </KakaoCustomOverlay>
    </KakaoMap>
  </div>
</template>
<style scoped>
#map {
  width: 100%;
  height: 100vh;
}
.overlaybox {
  position: relative;
  width: 50px;
  height: 65px;
}

.marker-select {
  -webkit-animation: marker-select 0.85s cubic-bezier(0.390, 0.575, 0.565, 1.000) infinite alternate both;
  animation: marker-select 0.85s cubic-bezier(0.390, 0.575, 0.565, 1.000) infinite alternate both;
}
@-webkit-keyframes marker-select {
  0% {
    -webkit-transform: scale(0.85);
    transform: scale(0.85);
    -webkit-transform-origin: 50% 100%;
    transform-origin: 50% 100%;
  }
  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    -webkit-transform-origin: 50% 100%;
    transform-origin: 50% 100%;
  }
}
@keyframes marker-select {
  0% {
    -webkit-transform: scale(0.85);
    transform: scale(0.85);
    -webkit-transform-origin: 50% 100%;
    transform-origin: 50% 100%;
  }
  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    -webkit-transform-origin: 50% 100%;
    transform-origin: 50% 100%;
  }
}
</style>