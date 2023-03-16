import { defineStore } from 'pinia'

export const useCounterStore = defineStore({
  // const count = ref(0)
  // const doubleCount = computed(() => count.value * 2)
  // function increment() {
  //   count.value++
  // }

  // return { count, doubleCount, increment }
  id: 'counter',
  state: () => ({
    count: 10
  }),
  actions:{
    increament(){
      return this.count++;
    },
    decreament(){
      return this.count--;
    }
  }
})
