<template>
  <h1>LOGIN PAGE</h1>
  <form @submit.prevent="authLogin">
    <div class="form-group">
      <label>Email address</label>
      <input type="email" class="form-control" v-model="params.email" aria-describedby="emailHelp"
        placeholder="Enter email">
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control" v-model="params.password" placeholder="Password">
    </div>
    <div class="form-group">
      <input type="checkbox" v-model="isRememberMe" id="rememberMe">
      <label for="rememberMe"> Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>
  
<script>
import axios from 'axios'
// import { useRouter, useRoute } from 'vue-router'
import { useUser } from '@/stores/useUser'
import { useRouter } from 'vue-router'
import { reactive, ref } from 'vue'


export default {

  data() {
    return {
      // isRememberMe : false
    }
  },
  setup() {
    const params = reactive({ email: "", password: "" })
    const storeUser = useUser();
    const router = useRouter();
    const isRememberMe = ref(false)

    const authLogin = async () => {

      const response =  await axios.post('auth/login', params)
        .catch(error => alert('Login Failed! Please try again'))

      storeUser.setUser(response.data.user)
      storeUser.setToken(response.data.token)

      if (isRememberMe.value) {
        localStorage.setItem('token', storeUser.token);
      }

      if (response.data.status == 'success') {
        alert(response.data.status)
        router.push('/');
      }
      else {
        alert(response.data.status)
        router.push('/login');
      }
      
    }

    return { authLogin, params, isRememberMe }
  },



}
</script>

<style></style>