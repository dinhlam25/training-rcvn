<template>
    <div >
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
                <a href="javascript:void(0)" @click="storeUser.handleClick">Logout</a>
            </li>
        </ul>
    </div>
</template>
<script setup>
import { useUser } from '@/stores/useUser'
const storeUser = useUser()


    // const token = storeUser.token
</script>
<script>
    import { useRouter } from 'vue-router'
    export default {
        setup() {
            const router = useRouter();
            return { router }
        },
        watch: {
            handleClick() {
                router.push('/login')
            }
        }
    }


</script>

<style></style>