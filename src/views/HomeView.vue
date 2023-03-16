<template>
    <h1>this is HomePage</h1>
    <div>
        <h2 v-if="!storeUser.user">
            you have login not yet
        </h2>
        <h2 v-else>
            Hello {{ storeUser.user.name }}, login success!
            <!-- {{ console.log() }} -->
        </h2>
    </div>
    <div>
        <!-- <h1>Hello {{ storeCounter.user }}</h1> -->
        <!-- <h2>{{ storeCounter.count }}</h2>
           <button  @click="inc">+</button>
           <button  @click="dec">-</button> -->
    </div>
</template>

<script setup>
// import { useCounterStore } from '@/stores/counter'
import { useUser } from '@/stores/useUser'
const storeUser = useUser()


// const storeCounter = useCounterStore();

// USEr

</script>



<style></style>