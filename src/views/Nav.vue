<template>
    <div>
        <ul v-if="!storeUser.token" class="d-flex justify-content-start">
            <li>
                <RouterLink to="/"><button class="btn btn-secondary">HomePage </button></RouterLink>
            </li>
            <li>
                <RouterLink to="/register"><button class="btn btn-secondary ml-5">Register </button></RouterLink>
            </li>
            <li>
                <RouterLink to="/login"><button class="btn btn-secondary ml-5">Login </button></RouterLink>
            </li>
        </ul>
        <ul v-else class="d-flex">
            <li class="ml-5">
                <RouterLink to="/dashboardUser"><button class="btn btn-secondary">Users</button></RouterLink>
            </li>
            <li class="ml-5">
                <RouterLink to="/dashboardProduct"><button class="btn btn-secondary">Products</button></RouterLink>
            </li>

            <li class="ml-auto mr-5">
                <button class="btn btn-primary" @click="handleClick">Logout</button>
            </li>
        </ul>
    </div>
</template>
<script>
import { useRouter } from 'vue-router'
import { useUser } from '@/stores/useUser'
import { computed } from 'vue';
export default {
    setup() {
        const router = useRouter();
        const storeUser = useUser();
        if (localStorage.getItem('token')) {
            storeUser.token = localStorage.getItem('token')
        }
        const handleClick = () => {
            //remove token local storage
            localStorage.clear()
            storeUser.token = storeUser.setToken(null)
            storeUser.user = storeUser.setUser(null)

            router.push('/login')
        }
        return { router, handleClick, storeUser }
    },

}
</script>

<style>
ul {
    list-style: none
}
</style>