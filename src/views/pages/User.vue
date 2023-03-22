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
        <div class="col-3"><p class="text-uppercase font-weight-bold">Tên</p></div>
        <div class="col-3"><p class="text-uppercase font-weight-bold">Email</p></div>
        <div class="col-3"><p class="text-uppercase font-weight-bold">Nhóm</p></div>
        <div class="col-3"><p class="text-uppercase font-weight-bold">Trạng thái</p></div>   
      </div>
      <div class="row">     
        <div class="input-group mb-3 col-3 dropdown">
          <input v-model="search" type="text" name="" id="" class="search-input" placeholder="Nhập họ tên">
        </div>

        <div class="input-group mb-3 col-3 dropdown">
          <input type="text" name="" id="" class="search-input" placeholder="Nhập email">
        </div>

        <div class="input-group mb-3 col-3 dropdown">
          <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Chọn nhóm">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
              aria-expanded="false"></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">admin</a></li>
              <li><a class="dropdown-item" href="#">editor</a></li>
              <li><a class="dropdown-item" href="#">reviewer</a></li>
            </ul>
          </div>
        </div>

        <div class="input-group mb-3 col-3 dropdown">
          <input type="text" class="form-control" aria-label="Text input with dropdown button"
            placeholder="Chọn trạng thái">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
              aria-expanded="false"></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Đang hoạt động</a></li>
              <li><a class="dropdown-item" href="#">Tạm khóa</a></li>
            </ul>
          </div>
        </div>

      </div>    
        <hr>
        <!-- Add Search and delete search btn-->
      <div class="row d-flex bd-highlight mb-3">
        <button type="button" class="col-2 btn btn-primary btn-lg mr-auto p-2 bd-highlight">Thêm mới</button>
        <button type="button" class="col-2 btn btn-primary btn-lg p-2 bd-highlight">Tìm kiếm</button>
        <button type="button" class="col-2 ml-5 btn btn-warning btn-lg p-2 bd-highlight">Xóa tìm</button>
      </div>
      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example" class="">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">6</a></li>
            <li class="page-item"><a class="page-link" href="#">7</a></li>
            <li class="page-item"><a class="page-link" href="#">8</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
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
                <tbody v-for="(user, id) in filteredName" :key="id">
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
                      <!-- <select class="form-control category-select" id="exampleFormControlSelect1">
      <option>Admin</option>
      <option>Editor</option>
      <option>Reviewer</option>
    </select> -->
                      <span class="text-muted">{{ user.status }}</span>

                    </td>
                    <td class="col-3">
                      <button type="button" class="btn btn-outline-info btn-circle btn btn-circle"><i
                          class="fa fa-key"></i> </button>
                      <button type="button" class="btn btn-outline-info btn-circle btn btn-circle ml-2"><i
                          class="fa fa-trash"></i> </button>
                      <button type="button" class="btn btn-outline-info btn-circle btn btn-circle ml-2"><i
                          class="fa fa-edit"></i> </button>
                      <button type="button" class="btn btn-outline-info btn-circle btn btn-circle ml-2"><i
                          class="fa fa-upload"></i> </button>
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
import axios from 'axios'
import { reactive } from 'vue'

export default {
  data() {
    return {
      users: null,
      search: ''
    }
  },
  setup() {
    // user = reactive(null)
  },
  async created() {
    await axios.get('http://127.0.0.1:8000/api/hello')
      .then(res => (this.users = res.data.data))
    // .then(res => (console.log(res.data)))
    // .catch(alert('lỗi rồi'))
  },
  computed: {
    filteredName() {
      if(this.search.trim().length > 0){
        return this.users.filter((user) => user.name.toLowerCase().includes
        (this.search.trim()))
      }
      return this.users
    }
  }
}

// return { user }
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
</style>