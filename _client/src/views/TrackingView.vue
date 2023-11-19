<template>
  <SideMenu />
  <BottomMenu />

  <div id="map" class="w-full h-screen"></div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { NaverMap, NaverMarker } from "vue3-naver-maps";

import NaverMapHelper from "@/helpers/NaverMap";

import SideMenu from "@/components/Menu.vue";
import BottomMenu from "@/components/BottomMenu.vue";

import MarkerDefaultSvg from '@/assets/svg/MarkerDefault.svg';
import MarkerTrackingSvg from '@/assets/svg/MarkerTracking.svg';

// vue3 mounteded
//  37.39964107585713, 경도는 37.39964107585713
onMounted(() => {
  // Create a new Naver Map instance
  const map = NaverMapHelper.createNaverMap('map', {lat: 37.39964107585713, lng: 126.97383494039487});

  const markers = ref([]);

  markers.value.push(NaverMapHelper.setMarkerPosition(map, {lat: 37.39964107585713, lng: 126.97373494039487}, {width: 65, height: 65}, MarkerDefaultSvg, 'GrandMother'));
  markers.value.push(NaverMapHelper.setMarkerPosition(map, {lat: 37.39964107585713, lng: 126.97383494039487}, {width: 60, height: 60}));
  
  for (var i=0, ii=markers.value.length; i<ii; i++) {
    const marker = markers.value[i];

    window.naver.maps.Event.addListener(marker, 'click', function() {
      const markerElement = marker.getElement();
      
      markerElement.classList.toggle("marker-select");
      // NaverMapHelper.updateMarker(marker, {width: 60, height: 60}, 'marker-select', MarkerTrackingSvg);
    });
  }  
});

</script>

<style scoped>

</style>