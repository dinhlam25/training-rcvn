import { defineStore } from "pinia";

export const useProduct = defineStore({
    id: "product",
    state: () => ({
        product: null
    }),
    getters: {

    },
    actions: {
        setProduct(data) {
            this.product = data;
        },
    }
})