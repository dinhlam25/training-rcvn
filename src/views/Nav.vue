<template>
    <div>
        <ul v-if="!storeUser.user">
            <li>
                <router-link to="/">HomePage </router-link>
            </li>
            <li>
                <RouterLink to="/register">Register </RouterLink>
            </li>
            <li>
                <RouterLink to="/login">Login </RouterLink>
            </li>
        </ul>
        <ul v-else>
            <li>
                <button class="btn btn-primary" @click="handleClick">Logout</button>
            </li>
        </ul>
    </div>
</template>
<script>
import { useRouter } from 'vue-router'
import { useUser } from '@/stores/useUser'
export default {
    setup() {
        const router = useRouter();
        const storeUser = useUser();
        const handleClick = () => {
            //remove token local storage
            localStorage.removeItem('token');
            // set user`
            //set token
            storeUser.token = storeUser.setToken(null)
            storeUser.user = storeUser.setUser(null)
            // redirect login
            router.push('/login')

        }
        return { router, handleClick, storeUser }
    },

}


</script>

<style></style>