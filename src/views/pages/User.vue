<template>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>User Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <div class="text-center mb-30">
      <h1 class="card-title text-uppercase">User Management</h1>
    </div>
    <div class="container">
      <!-- Searching -->
      <div class="row">
        <div class="col-3">
          <p class="text-uppercase font-weight-bold">Tên</p>
        </div>
        <div class="col-3">
          <p class="text-uppercase font-weight-bold">Email</p>
        </div>
        <div class="col-3">
          <p class="text-uppercase font-weight-bold">Nhóm</p>
        </div>
        <div class="col-3">
          <p class="text-uppercase font-weight-bold">Trạng thái</p>
        </div>
      </div>
      <div class="row">
        <div class="input-group mb-3 col-3 dropdown">
          <input v-model="paramsSearch.name" type="text" name="" id="" class="search-input" placeholder="Nhập họ tên">
        </div>

        <div class="input-group mb-3 col-3 dropdown">
          <input v-model="paramsSearch.email" type="text" name="" id="" class="search-input" placeholder="Nhập email">
        </div>

        <div class="input-group mb-3 col-3">
          <select v-model="paramsSearch.group" class="form-control" id="exampleFormControlSelect1">
            <option value="">Chọn nhóm</option>
            <option value="admin">admin</option>
            <option value="editor">editor</option>
            <option value="reviewer">reviewer</option>
          </select>
        </div>

        <div class="input-group mb-3 col-3">
          <select v-model="paramsSearch.status" class="form-control" id="exampleFormControlSelect1">
            <option value="">Chọn trạng thái</option>
            <option value="1">Đang hoạt động</option>
            <option value="0">Tạm khóa</option>
          </select>
        </div>
      </div>
      <hr>
      <!-- Add Search and delete search btn-->
      <div class="row d-flex bd-highlight mb-3">
        <button data-toggle="modal" data-target="#myModal" type="button"
          class="col-2 btn btn-primary btn-lg mr-auto p-2 bd-highlight" @click="clearUser()">Thêm mới</button>
        <button @click="() => handleSearch()" type="button" class="col-2 btn btn-primary btn-lg p-2 bd-highlight">Tìm
          kiếm</button>
        <button @click="() => handleSearch(1, {})" type="button"
          class="col-2 ml-5 btn btn-warning btn-lg p-2 bd-highlight">Xóa tìm</button>
      </div>

      <!-- Modal Manager User -->
      <ManagerUser :edit="user" @update:reload="handleSearch()" @update:save="clickAdd" />
      <SetStatus :userData="user" @update:reload="handleSearch()" />
      <DeleteUser :userData="user" @update:reload="handleSearch()"/>

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        <paginate v-model="curPageUser" :page-count="lastPageUser" :page-range="4" :margin-pages="2"
          :click-handler="handleSearch" :prev-text="'&laquo;'" :next-text="'&raquo;'" :container-class="'pagination'"
          :page-class="'page-item'">

        </paginate>
      </div>
      <!--Count User -->
      <div class="d-flex justify-content-end">
        <p>Hiển thị <strong>{{ fromUser }} ~ {{ toUser }}</strong> trong tổng số <strong>{{ totalUser }}</strong> users
        </p>
      </div>
      <hr>
      <!-- table list user -->
      <div class="row">
        <div class="col-md-12">
          <div class="card-login">

            <div class="table-responsive">
              <table class="table no-wrap user-table mb-0">
                <!-- <th scope="col" class="border-0 text-uppercase font-medium pl-4">{{ user.key[0] }}</th> -->
                <thead style="background-color:blue;color: aliceblue;">
                  <tr>
                    <!-- <th scope="col" class="border-0 text-uppercase font-medium"
      v-for="(item,key,index) in users.data" :key="index" 
    >{{ key }}</th> -->
                    <th scope="col" class="border-0 text-uppercase font-medium">id</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">name</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">email</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">group</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">last login</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">status</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>

                  </tr>
                </thead>
                <tbody v-for="(user, id) in users" :key="id">
                  <tr>
                    <td class="">{{ user.id }}</td>
                    <!-- <td v-for="(item,i) in filteredItems" :key="i" class="col-2"> -->
                    <td class="col-2">
                      <h5 class="font-medium mb-0">{{ user.name }}</h5>
                    </td>
                    <td class="col-2">
                      <span class="text-muted"><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                          data-cfemail="85e1e4ebece0e9c5f2e0e7f6ecf1e0abe6eae8">{{ user.email }}</a></span><br>
                    </td>
                    <td class="">
                      <span class="text-muted">{{ user.group }}</span><br>
                    </td>
                    <td class="col-2">
                      <span class="text-muted">{{ user.last_login }}</span><br>

                    </td>
                    <td class="col-2">

                      <span class="text-muted">{{ user.status }}</span>

                    </td>
                    <td class="col-3">
                      <button @click="clickEdit(user)" data-toggle="modal" data-target="#ModalUpdateUser" type="button"
                        class="btn btn-outline-info btn-circle btn btn-circle"><i class="fa fa-edit"></i> </button>
                      <button @click="clickStatus(user)" data-toggle="modal" data-target="#ModalStatus" type="button"
                        class="btn btn-outline-info btn-circle btn btn-circle ml-3"><i class="fa fa-key"></i> </button>
                      <button @click="clickDelete(user)"  data-toggle="modal" data-target="#ModalDelete" type="button"
                        class="btn btn-outline-info btn-circle btn btn-circle ml-3"><i class="fa fa-trash"></i> </button>
                      <!-- <button type="button" class="btn btn-outline-info btn-circle btn btn-circle ml-2"><i
                          class="fa fa-upload"></i> </button> -->
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>

  </html>
</template>
<script>
import Paginate from 'vuejs-paginate-next'
import axios from 'axios'
import { reactive, ref } from 'vue'
import ManagerUser from '../../components/User/ManagerUser.vue'
import SetStatus from '../../components/User/SetStatus.vue'
import DeleteUser from '../../components/User/DeleteUser.vue'

export default {
  data() {
    return {
      user: {},
      users: null,
      fullDataUser: null,


      curPageUser: 1,
      fromUser: null,
      toUser: null,
      totalUser: null,
    }
  },
  components: {
    paginate: Paginate,
    ManagerUser,
    SetStatus,
    DeleteUser
  },
  setup() {
    const paramsSearch = reactive({ name: "", email: "", group: "", status: "" })
    const lastPageUser = ref(1)

    return { paramsSearch, lastPageUser }
  },

  created() {
    this.handleSearch();
  },
  methods: {

    async handleSearch(page = 1, paramsSearch = this.paramsSearch,) {
      const response = await axios.get('users', { params: { ...paramsSearch, page } })
        .then(res => {
          const { data, meta } = res.data;

          // const data = res.data.data
          // const meta = res.data.meta

          this.users = data
          this.curPageUser = meta.current_page
          this.fromUser = meta.from
          this.toUser = meta.to
          this.totalUser = meta.total
          this.lastPageUser = meta.last_page
          // console.log('data on start :', res.data)

        })
        .catch(error => {
          console.log(error)
          alert('Delete Search Failed! Please try again')
        })
    },
    async handleUpdate(paramsUser) {
      const response = await axios.post('users/create',paramsUser)
                                  .then(res => {alert('Update success'); this.handleSearch()})
                                  .catch(error =>{ alert(error); console.log(error)} )
    },
 
    clearUser(){
      this.user = {
                name: "",
                email: "",
                group: "",
                status: "",
            }
    },
    clickAdd(newUser) {
      this.handleUpdate(newUser)
    },
    clickEdit(editUser) {
      this.user = editUser
    },
    clickStatus(statusUser) {
      this.user = statusUser
    },
    clickDelete(deleteUser) {
      this.user = deleteUser
      console.log(deleteUser)
    }
  },
  computed: {

  },
  watch: {

    }
  }


</script>
<style type="text/css">
body {
  background: #e8eaeb;
  margin-top: 20px;
}

.card-login {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 0 solid transparent;
  border-radius: 0;
}

.search-input {
  width: 300px;
  border-radius: 3px;
}

.btn-circle.btn-lg,
.btn-group-lg>.btn-circle.btn {
  width: 50px;
  height: 50px;
  padding: 14px 15px;
  font-size: 18px;
  line-height: 23px;
}

.text-muted {
  color: #8898aa !important;
}

[type=button]:not(:disabled),
[type=reset]:not(:disabled),
[type=submit]:not(:disabled),
button:not(:disabled) {
  cursor: pointer;
}

.btn-circle {
  border-radius: 100%;
  width: 40px;
  height: 40px;
  padding: 10px;
}

.user-table tbody tr .category-select {
  max-width: 150px;
  border-radius: 20px;
}

.modal-backdrop {
  z-index: -1;
}
</style>