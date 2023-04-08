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
      
            <Form @submit="authLogin" :validation-schema="schema">
              <div class="input-group form-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-file-earmark-person-fill"></i></span>
                </div>
                <Field  v-model="params.email" name="email" type="text" class="form-control" placeholder="username" />
              </div>
              <span class="ml-5 mb-3"><ErrorMessage name="email" style="color:red"/></span>
              <div class="input-group form-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                </div>
                <Field  v-model="params.password" name="password" type="password" class="form-control"
                  placeholder="password" />
                </div>
                <span class="ml-5 mb-3"><ErrorMessage name="password" style="color:red"/></span>
              <div class="row align-items-center remember">
                <input type="checkbox" :value="!isRememberMe" v-model="params.isRememberMe">Remember Me
              </div>
              <div class="form-group">
                <input type="submit" value="Login" class="btn float-right login_btn">
              </div>
            </Form>
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
import { useUser } from '@/stores/useUser'
import { useRouter } from 'vue-router'
import { reactive, ref } from 'vue'
import * as yup from 'yup';
import { Form, Field, ErrorMessage } from 'vee-validate';


export default {
  components: {
    Form, Field, ErrorMessage
  },
  data() {
    return {
      // isRememberMe : false
    }
  },
  setup() {
    const schema = yup.object({
      email: yup.string().required().email(),
      password: yup.string().required().min(8),
    });
    // OLD CODE
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

    }
    return { authLogin, params, schema }
  },
  // function: {
  //   validateField(value) {
  //     if (!value) {
  //       return 'this field is required';
  //     }

  //     if (value.length < 8) {
  //       return 'this field must contain at least 8 characters';
  //     }

  //     return true;
  //   }
  // },
  methods: {
    
  }


}
</script>

<style>
/* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,
body {
  /* background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg'); */
  /* background-size: cover; */
  background: #e8eaeb;
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