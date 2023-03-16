import { defineStore } from "pinia";
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios';

export const useUser = defineStore({
    id: "user",
    state: () => ({
        status: null,
        message: null,
        user: null,
        token: null,
    }),
    getters: {

    },
    actions: {
        setUser(data) {
            this.user = data;
        },
        setToken(data) {
            this.token = data;
        },
        // async fetchUsers() {
        //     try {
        //         const response = await axios.get('auth/info')
        //         this.user = response.data
        //         localStorage.getItem('token')
        //     } catch (error) {
        //         console.log(error)
        //     }
        // },
        handleClick() {
            {
                const router = useRouter();
                this.user = null;
                this.token = null;                
                localStorage.removeItem('token');
                router.push('/');
            }
        }
    }
    // actions:
})