<script setup lang="ts">
import { ref } from 'vue';
import KakaoMap from '@/components/KakaoMap/KakaoMap.vue';
import KakaoCustomOverlay from '@/components/KakaoMap/KakaoCustomOverlay.vue';

import MarkerDefaultSvg from '@/assets/svg/MarkerDefault.svg';
import MarkerTrackingSvg from '@/assets/svg/MarkerTracking.svg';

const gps_use = ref(false); //gps의 사용가능 여부
const gps_lat = ref(0.0); // 위도
const gps_lng = ref(0.0); // 경도
const gps_position = ref({lat: 0.0, lng: 0.0}); // gps 위치 객체

gps_check();
// gps가 이용가능한지 체크하는 함수이며, 이용가능하다면 show location 함수를 불러온다.
// 만약 작동되지 않는다면 경고창을 띄우고, 에러가 있다면 errorHandler 함수를 불러온다.
// timeout을 통해 시간제한을 둔다.
function gps_check(){
  if (navigator.geolocation) {
    var options = {timeout:60000};
    navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
  } else {
    alert("GPS_추적이 불가합니다.");
    gps_use.value = false;
  }
}


// gps 이용 가능 시, 위도와 경도를 반환하는 showlocation함수.
function showLocation(position) {
  gps_use.value = true;
  gps_lat.value = position.coords.latitude;
  gps_lng.value = position.coords.longitude;
  gps_position.value = {lat: gps_lat.value, lng: gps_lng.value};
}


// error발생 시 에러의 종류를 알려주는 함수.
function errorHandler(error) {
  if(error.code == 1) {
    alert("접근차단");
  } else if( err.code == 2) {
    alert("위치를 반환할 수 없습니다.");
  }
  gps_use.value = false;
}
</script>


<template>
  <div id="map">
    <KakaoMap :center="gps_position" :usePanTo="true" :level="2">
      <KakaoCustomOverlay :position="gps_position">
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