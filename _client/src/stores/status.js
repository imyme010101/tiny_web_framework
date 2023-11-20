import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useStatusStore = defineStore('status', () => {
  const isSideMenu = ref(false)
  const wardIndex = ref(0)

  function toggleSideMenu() {
    isSideMenu.value = !isSideMenu.value
  }

  function setWard(index) {
    wardIndex.value = index
  }

  return {
    isSideMenu,
    toggleSideMenu,
    wardIndex,
    setWard
  }
});