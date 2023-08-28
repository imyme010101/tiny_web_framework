import { defineStore } from "pinia";

export const useTestStore = defineStore("test", {
  state: () => {
    return { count: 2 };
  },
  actions: {
    countPlus() {
      this.count += 1;
    },
  },
  getters: {
    countState: (state) => {
      return state.count * 3;
    },
  },
});