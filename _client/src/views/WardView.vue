<template>
  <SideMenu />
  <BottomMenu />

  <div id="map" class="w-full h-screen"></div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useStatusStore } from "@/stores/status";

const statusStore = useStatusStore()
const { wardIndex } = storeToRefs(statusStore);

import NaverMapHelper from "@/helpers/NaverMap";

import SideMenu from "@/components/Menu.vue";
import BottomMenu from "@/components/BottomMenu.vue";

import MarkerDefaultSvg from '@/assets/svg/MarkerDefault.svg';
import MarkerGuardianSvg from '@/assets/svg/MarkerGuardianSvg.svg';
import MarkerTrackingSvg from '@/assets/svg/MarkerTracking.svg';

// vue3 mounteded
//  37.39964107585713, 경도는 37.39964107585713
onMounted(() => {
  // Create a new Naver Map instance
  const map = NaverMapHelper.createNaverMap('map', {lat: 37.39964107585713, lng: 126.97383494039487});

  const markers = ref([]);

  markers.value.push(NaverMapHelper.setMarkerPosition(map, 1,{lat: 37.39964107585713, lng: 126.97373494039487}, {width: 70, height: 70}, '#04BBA4', null, {name: '장진수', color: '#fff'}));
  markers.value.push(NaverMapHelper.setMarkerPosition(map, 'guardian', {lat: 37.39964107585713, lng: 126.97383494039487}, {width: 70, height: 70}, '#FFB000', null, {name: '나', color: '#fff'}));

  window.naver.maps.Event.addListener(map, 'zoom_changed', function() {
    markerClearHandler(markers);
  });
  window.naver.maps.Event.addListener(map, 'dragstart', function() {
    markerClearHandler(markers);
  });
  window.naver.maps.Event.addListener(map, 'dragend', function() {
    // markerClearHandler(markers);
  });
  window.naver.maps.Event.addListener(map, 'click', function() {
    markerClearHandler(markers);
  });


  // 마커 클릭 이벤트
  for (var i=0, ii=markers.value.length; i<ii; i++) {
    const marker = markers.value[i];

    window.naver.maps.Event.addListener(marker, 'click', function() {
      markerClickHandler(markers, marker);
      // NaverMapHelper.updateMarker(marker, {width: 60, height: 60}, 'marker-select', MarkerTrackingSvg);
    });
  }

  function markerClearHandler(markers) {
    for (var j=0, jj=markers.value.length; j<jj; j++) {
      markers.value[j].getElement().getElementsByClassName('marker-box')[0].classList.remove('marker-select');
    }
    statusStore.setWard(0);
  }
  function markerClickHandler(markers, marker) {
    markerClearHandler(markers);

    const markerElement = marker.getElement().getElementsByClassName('marker-box')[0];
    const markerIndex = markerElement.dataset.index;

    if(markerIndex === 'guardian') {
      statusStore.setWard(0);

      return;
    }

    statusStore.setWard(markerIndex);

    markerElement.classList.add("marker-select");
  }
});

</script>

<style scoped>

</style>