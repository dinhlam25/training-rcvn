<template>
  <h1>REGISTER PAGE</h1>
  <form @submit.prevent="storeRegisterInfo" class="container">
    <div class="form-group">
      <label>name</label>
      <input type="text" class="form-control" v-model="params.name" placeholder="Enter your">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" v-model="params.email" id="exampleInputEmail1" aria-describedby="emailHelp"
        placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" v-model="params.password" id="exampleInputPassword1"
        placeholder="Password">
    </div>
    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
import axios from 'axios'
import { reactive } from 'vue'
import { useUser } from '@/stores/useUser'
import { useRouter } from 'vue-router'


export default {
  // name: Register,
  setup() {
    const params = reactive({ name: "", email: "", password: "" })
    const storeUser = useUser();
    const router = useRouter();

    const storeRegisterInfo = async () => {
      {
        const response = await axios.post('auth/register', params)
          .then(response => { 
            alert("Register Success")
            router.push('/login')
          })
          .catch(error => {
            const arr = error.response.data.errors
            if (arr.email !== null) {
              console.log(arr.email)
            }
            if (arr.password !== null) {
              console.log(arr.password)
            }
            if (arr.name !== null) {
              console.log(arr.name)
            }
            router.push('/register')
            alert('Register Failed! Please try again')
          });


        // if(storeUser.status == 'success'){
        //   router.push('/login')
        //   alert(storeUser.message)
        // }
        // else {
        //   router.push('/register')
        //   alert('Register Fail! Please try again')
        // }
      }
    }
    return { storeRegisterInfo, params }
  },
  // methods: {
  //   async storeRegisterInfo() {
  //     const response = await axios.post('http://127.0.0.1:8000/api/auth/register', { params });
  //   }
  // },


}
</script>

<style></style>