<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStatusStore } from "@/stores/status";

const statusStore = useStatusStore()
const { isSideMenu } = storeToRefs(statusStore);

console.log(isSideMenu);

const selected = ref(0);
const nav = [
  {
    icon:
      '<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
    selectedIcon:
      '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>',
    text: "Dashboard",
  },
  {
    icon:
      '<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>',
    selectedIcon:
      '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>',
    text: "Analytics",
  },
  {
    icon:
      '<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    selectedIcon:
      '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>',
    text: "Schedules",
  },
  {
    icon:
      '<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
    selectedIcon:
      '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>',
    text: "Acount Manager",
  },
  {
    icon:
      '<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>',
    selectedIcon:
      '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>',
    text: "File Manager",
  },
  {
    icon:
      '<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
    selectedIcon:
      '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>',
    text: "Group Manager",
  },
];

const enlarge = {
  decrease:
    '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>',
  enlarge:
    '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>',
  text: "Group Manager",
};

const user = {
  name: "John Doe",
  role: "CEO",
  avatar: "https://images.unsplash.com/photo-1558898479-33c0057a5d12?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&ixid=eyJhcHBfaWQiOjE0NTg5fQ",
};
</script>

<template>

<button
  class="fixed top-0 left-0 z-[111]"
  @click="statusStore.toggleSideMenu"
>
  <svg v-if="isSideMenu" width="50" height="50" viewBox="0 0 50 50" fill="#1C274C" xmlns="http://www.w3.org/2000/svg">
    <path d="M39 16.5C39.8284 16.5 40.5 17.1716 40.5 18C40.5 18.8284 39.8284 19.5 39 19.5V16.5ZM11 19.5C10.1716 19.5 9.5 18.8284 9.5 18C9.5 17.1716 10.1716 16.5 11 16.5V19.5ZM39 24.5C39.8284 24.5 40.5 25.1716 40.5 26C40.5 26.8284 39.8284 27.5 39 27.5V24.5ZM15 27.5C14.1716 27.5 13.5 26.8284 13.5 26C13.5 25.1716 14.1716 24.5 15 24.5V27.5ZM39 32.5C39.8284 32.5 40.5 33.1716 40.5 34C40.5 34.8284 39.8284 35.5 39 35.5V32.5ZM25 35.5C24.1716 35.5 23.5 34.8284 23.5 34C23.5 33.1716 24.1716 32.5 25 32.5V35.5ZM39 19.5H11V16.5H39V19.5ZM39 27.5H15V24.5H39V27.5ZM39 35.5H25V32.5H39V35.5Z" fill="#1C274C"/>
  </svg>

  <svg v-else width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M13 24.5C12.1716 24.5 11.5 25.1716 11.5 26C11.5 26.8284 12.1716 27.5 13 27.5V24.5ZM37 27.5C37.8284 27.5 38.5 26.8284 38.5 26C38.5 25.1716 37.8284 24.5 37 24.5V27.5ZM13 32.5C12.1716 32.5 11.5 33.1716 11.5 34C11.5 34.8284 12.1716 35.5 13 35.5V32.5ZM37 35.5C37.8284 35.5 38.5 34.8284 38.5 34C38.5 33.1716 37.8284 32.5 37 32.5V35.5ZM13 16.5C12.1716 16.5 11.5 17.1716 11.5 18C11.5 18.8284 12.1716 19.5 13 19.5V16.5ZM37 19.5C37.8284 19.5 38.5 18.8284 38.5 18C38.5 17.1716 37.8284 16.5 37 16.5V19.5ZM13 27.5H37V24.5H13V27.5ZM13 35.5H37V32.5H13V35.5ZM13 19.5H37V16.5H13V19.5Z" fill="#1C274C"/>
  </svg>
</button>

<div 
  class="fixed top-0 left-0 z-[111] w-full h-screen flex transition-transform duration-500 transform-gpu pointer-events-none"
  :class="{ 'transform-none': isSideMenu, '-translate-x-full': !isSideMenu }"
>
  <div
    class="fixed top-0 left-0 bottom-0 right-0 w-full h-screen bg-[#000000a8]"
    :class="[{ 'pointer-events-auto': isSideMenu }]"
    @click="statusStore.toggleSideMenu"
  ></div>
  <aside
    class="relative inline-flex flex-col items-center px-2 bg-white"
  >
    <nav class="inline-flex flex-col space-y-2">
      <div
        class="flex justify-end"
      >
        <button
          class="pointer-events-auto"
          @click="statusStore.toggleSideMenu"
        >
          <svg v-if="isSideMenu" width="50" height="50" viewBox="0 0 50 50" fill="#1C274C" xmlns="http://www.w3.org/2000/svg">
            <path d="M39 16.5C39.8284 16.5 40.5 17.1716 40.5 18C40.5 18.8284 39.8284 19.5 39 19.5V16.5ZM11 19.5C10.1716 19.5 9.5 18.8284 9.5 18C9.5 17.1716 10.1716 16.5 11 16.5V19.5ZM39 24.5C39.8284 24.5 40.5 25.1716 40.5 26C40.5 26.8284 39.8284 27.5 39 27.5V24.5ZM15 27.5C14.1716 27.5 13.5 26.8284 13.5 26C13.5 25.1716 14.1716 24.5 15 24.5V27.5ZM39 32.5C39.8284 32.5 40.5 33.1716 40.5 34C40.5 34.8284 39.8284 35.5 39 35.5V32.5ZM25 35.5C24.1716 35.5 23.5 34.8284 23.5 34C23.5 33.1716 24.1716 32.5 25 32.5V35.5ZM39 19.5H11V16.5H39V19.5ZM39 27.5H15V24.5H39V27.5ZM39 35.5H25V32.5H39V35.5Z" fill="#1C274C"/>
          </svg>

          <svg v-else width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 24.5C12.1716 24.5 11.5 25.1716 11.5 26C11.5 26.8284 12.1716 27.5 13 27.5V24.5ZM37 27.5C37.8284 27.5 38.5 26.8284 38.5 26C38.5 25.1716 37.8284 24.5 37 24.5V27.5ZM13 32.5C12.1716 32.5 11.5 33.1716 11.5 34C11.5 34.8284 12.1716 35.5 13 35.5V32.5ZM37 35.5C37.8284 35.5 38.5 34.8284 38.5 34C38.5 33.1716 37.8284 32.5 37 32.5V35.5ZM13 16.5C12.1716 16.5 11.5 17.1716 11.5 18C11.5 18.8284 12.1716 19.5 13 19.5V16.5ZM37 19.5C37.8284 19.5 38.5 18.8284 38.5 18C38.5 17.1716 37.8284 16.5 37 16.5V19.5ZM13 27.5H37V24.5H13V27.5ZM13 35.5H37V32.5H13V35.5ZM13 19.5H37V16.5H13V19.5Z" fill="#1C274C"/>
          </svg>
        </button>
      </div>

      <a
        v-for="(link, index) in nav"
        class="flex items-center text-gray-600 py-2 cursor-pointer pl-2 pr-6 rounded-lg"
        :class="[
          [selected == index ? 'bg-indigo-100 text-indigo-500' : 'hover:bg-gray-100'],
        ]"
        @click="selected = index"
      >
        <span
          v-html="selected == index ? link.selectedIcon : link.icon"
          class="w-8 h-8 p-1 mr-4"
        ></span>
        <span v-html="link.text" class="font-medium select-none"></span>
      </a>
    </nav>
  </aside>
</div>


</template>
