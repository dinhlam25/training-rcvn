<!-- <template>
  <div class="wrapper">
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
</div>
</template> -->
<template>
  <head>
    <title>Login Page</title>
  </head>

  <body>
    <div class="container">
      <div class="d-flex justify-content-center h-100">
        <div class="card">
          <div class="card-header">
            <h3>Sign In</h3>
            <div class="d-flex justify-content-end social_icon">
              <span><i class="bi bi-facebook"></i></span>
              <span><i class="bi bi-google"></i></span>
              <span><i class="bi bi-twitter"></i></span>
            </div>
          </div>
          <div class="card-body">
            <form @submit.prevent="authLogin">
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-file-earmark-person-fill"></i></span>
                </div>
                <input v-model="params.email" type="text" class="form-control" placeholder="username">

              </div>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                </div>
                <input v-model="params.password" type="password" class="form-control" placeholder="password">
              </div>
              <div class="row align-items-center remember">
                <input type="checkbox" :value="!isRememberMe" v-model="params.isRememberMe">Remember Me
              </div>
              <div class="form-group">
                <input type="submit" value="Login" class="btn float-right login_btn">
              </div>
            </form>
          </div>
          <div class="card-footer">
            <div class="d-flex justify-content-center links">
              Don't have an account?<a href="#">Sign Up</a>
            </div>
            <div class="d-flex justify-content-center">
              <a href="#">Forgot your password?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
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
    const params = reactive({ email: "", password: "", isRememberMe: false })
    const storeUser = useUser()
    const router = useRouter()
    // const isRememberMe = ref(false)
 

    const authLogin = async () => {
      const response = await axios.post('auth/login', params)
        .catch(error => alert('Login Failed! Please try again'))
      storeUser.setUser(response.data.user)
      storeUser.setToken(response.data.token)

      if (storeUser.token) {
        localStorage.setItem('token', storeUser.token)
      }

      if (response.data.status == 'success') {
        alert(response.data.status)
        router.push('/dashboardUser');
      }
      // else {
      //   alert(response.data.status)
      //   router.push('/login');
      // }

    }

    return { authLogin, params }
  },



}
</script>

<style>
/* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,
body {
  /* background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg'); */
  /* background-size: cover; */
  background-repeat: no-repeat;
  height: 100%;
  font-family: 'Numans', sans-serif;
}

.container {
  height: 100%;
  align-content: center;
}

.card {
  height: 370px;
  margin-top: auto;
  margin-bottom: auto;
  width: 400px;
  background-color: rgba(0, 0, 0, 0.5) !important;
}

.social_icon span {
  font-size: 60px;
  margin-left: 10px;
  color: #FFC312;
}

.social_icon span:hover {
  color: white;
  cursor: pointer;
}

.card-header h3 {
  color: white;
}

.social_icon {
  position: absolute;
  right: 20px;
  top: -45px;
}

.input-group-prepend span {
  width: 50px;
  background-color: #FFC312;
  color: black;
  border: 0 !important;
}

input:focus {
  outline: 0 0 0 0 !important;
  box-shadow: 0 0 0 0 !important;

}

.remember {
  color: white;
}

.remember input {
  width: 20px;
  height: 20px;
  margin-left: 15px;
  margin-right: 5px;
}

.login_btn {
  color: black;
  background-color: #FFC312;
  width: 100px;
}

.login_btn:hover {
  color: black;
  background-color: white;
}

.links {
  color: white;
}

.links a {
  margin-left: 4px;
}
</style>