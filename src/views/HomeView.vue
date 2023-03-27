<template>
    <div v-if="!storeUser.user">
        <h2 >
            <h1>this is HomePage</h1>
            you have login not yet
        </h2>
        <!-- <b-alert show>Default Alert</b-alert> -->
        <!-- <h2 v-else>
            Hello {{ storeUser.user.name }}, login success!
        </h2> -->
    </div>

</template>

<script setup>
import { useUser } from '@/stores/useUser'
const storeUser = useUser()


</script>
