<template>
    <div>
        <router-link to="/">HomePage </router-link>
            <ul v-if="!storeUser.user">
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


</script>

<style></style>