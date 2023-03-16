

<template>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <header>

    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

  </header>

  <body>

  <div class="wrapper">
      <!-- <Nav :user="user" />
            <RouterView :user="user" /> -->
      <Nav />
      <RouterView />
    </div>
  </body>
</template>
<script setup>

import Nav from './views/Nav.vue'
 


// export default {
//   name: 'App',
//   data() {
//     return {
//       user: null,
//     }
//   },
  // created() {
  //   this.fetchUsers()
  // },
  // methods: {
  //   async fetchUsers() {
  //     try {
  //       const response = await axios.get('auth/info')
  //       this.user = response.data
  //       // console.log(this.user);
  //     } catch (error) {
  //       console.log(error)
  //     }
  //   },
  // },


// }
</script>