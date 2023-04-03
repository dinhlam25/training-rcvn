<template>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Product Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <div class="text-center mb-30">
      <h1 class="card-title text-uppercase">Product Management</h1>
    </div>
    <div class="container">
      <!-- Searching -->
      <div class="row">
        <div class="col-3">
          <p class="text-uppercase font-weight-bold">Tên Sản Phẩm</p>
        </div>
        <div class="col-3">
          <p class="text-uppercase font-weight-bold">Trạng thái</p>
        </div>
        <div class="col-2">
          <p class="text-uppercase font-weight-bold">Giá bán từ</p>
        </div>
        <div class="col-2 ml-5">
          <p class="text-uppercase font-weight-bold">Giá bán đến</p>
        </div>
      </div>
      <div class="row">
        <div class="input-group mb-3 col-3 dropdown">
          <input v-model="paramsSearch.productName" type="text" name="" id="" class="search-input"
            placeholder="Nhập tên sản phẩm">
        </div>


        <!-- <div class="input-group mb-3 col-3">
          <select v-model="paramsSearch.group" class="form-control" id="exampleFormControlSelect1">
            <option value="">Chọn trạng thái</option>
            <option value="admin">admin</option>
            <option value="editor">editor</option>
            <option value="reviewer">reviewer</option>
          </select>
        </div> -->

        <div class="input-group mb-3 col-3">
          <select v-model="paramsSearch.isSales" class="form-control" id="exampleFormControlSelect1">
            <option value="">Chọn trạng thái</option>
            <option value="-1">Ngừng bán</option>
            <option value="1">Đang bán</option>
            <option value="0">Hết hàng</option>
          </select>
        </div>

        <div class="input-group mb-3 col-2 ">
          <input v-model="paramsSearch.productPriceFrom" type="text" name="" id="" class="search-input" placeholder="nhập giá min">
        </div>

        <div class="ml-3 mt-2" style="font-size: large;">
          <span><strong>~</strong></span>
        </div>

        <div class="input-group mb-3 col-2  ">
          <input v-model="paramsSearch.productPriceTo" type="text" name="" id="" class="search-input" placeholder="nhập giá max">
        </div>
      </div>
      <hr>

      <!-- Add Search and delete search btn-->
      <div class="row d-flex bd-highlight mb-3">
        <button data-toggle="modal" data-target="#ModalUpdateUser" type="button"
          class="col-2 btn btn-primary btn-lg mr-auto p-2 bd-highlight" >Thêm mới</button>
        <button @click="() => handleSearch()" type="button" class="col-2 btn btn-primary btn-lg p-2 bd-highlight">Tìm
          kiếm</button>
        <button @click="() => handleSearch(1, {})" type="button"
          class="col-2 ml-5 btn btn-warning btn-lg p-2 bd-highlight">Xóa tìm</button>
      </div>

      <!-- Modal Manager User -->
      <!-- <ManagerUser :edit="user" @update:reload="handleSearch()" @update:save="clickAdd" />
      <SetStatus :userData="user" @update:reload="handleSearch()" />
      <DeleteUser :userData="user" @update:reload="handleSearch()" /> -->

      <!-- Pagination -->
      <div class="d-flex justify-content-center">
        <paginate v-model="curPageProduct" :page-count="lastPageProduct" :page-range="4" :margin-pages="2"
          :click-handler="handleSearch" :prev-text="'&laquo;'" :next-text="'&raquo;'" :container-class="'pagination'"
          :page-class="'page-item'">

        </paginate>
      </div>
      <!--Count Product -->
      <div class="d-flex justify-content-end">
        <p>Hiển thị <strong>{{ fromProduct }} ~ {{ toProduct }}</strong> trong tổng số <strong>{{ totalProduct }}</strong> products
        </p>
      </div>
      <hr>
      <!-- table list product -->
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
                    <th scope="col" class="border-0 text-uppercase font-medium">description</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">price</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">status</th>
                    <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>

                  </tr>
                </thead>
                <tbody v-for="(product, product_id) in products" :key="product_id">
                  <tr>
                    <td class="col-1">{{ product.product_id }}</td>
                    <!-- <td v-for="(item,i) in filteredItems" :key="i" class="col-2"> -->
                    <td class="col-2">
                      <h5 class="font-medium mb-0">{{ product.product_name }}</h5>
                    </td>
                    <td class="col-5">
                      <span class="text-muted">{{ product.description }}</span><br>
                    </td>
                    <td class="col-1">
                      <span class="text-muted">${{ product.product_price }}</span><br>
                    </td>
                    <td class="col-1">
                      <span class="text-muted">{{ product.is_sales }}</span><br>
                    </td>
  
                    <td class="col-3">
                      <RouterLink to="/dashboardProduct/detail"><button @click="clickEdit(product)" data-toggle="modal" data-target="#ModalUpdateUser" type="button"
                        class="btn btn-outline-info btn-circle btn btn-circle"><i class="fa fa-edit"></i></button></RouterLink>
                 
                      <button @click="clickDelete(product)" data-toggle="modal" data-target="#ModalDelete" type="button"
                        class="btn btn-outline-info btn-circle btn btn-circle ml-3"><i class="fa fa-trash"></i> </button>
                 
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
  <router-view></router-view>

</template>
<script>
import Paginate from 'vuejs-paginate-next'
import axios from 'axios'
import { reactive, ref, onMounted } from 'vue'
import { useProduct } from '@/stores/useProduct'

export default {
  data() {
    return {

    }
  },
  components: {
    paginate: Paginate,
    // ManagerUser,
    // SetStatus,
    // DeleteUser
  },
  setup() {
    const product  = reactive({product_id: "", product_name: "", product_price: "", description: "", is_sales: "" });
    const products = ref(0);
    const curPageProduct = ref(1);
    const fromProduct = ref(0);
    const toProduct = ref(0);
    const totalProduct = ref(0);
    const lastPageProduct = ref(0);


    const paramsSearch = reactive({ productName: "", isSales: "", productPriceFrom: "", productPriceTo: "" })
    const storeProduct = useProduct();
    
    onMounted(

      async () => {
        const response = await axios.get('products')
        .then(res => {
          const { data, meta } = res.data;
          // const data = res.data.data
          // const meta = res.data.meta

          products.value = data
          curPageProduct.value = meta.current_page
          fromProduct.value = meta.from
          toProduct.value = meta.to
          totalProduct.value = meta.total
          lastPageProduct.value = meta.last_page
        })
        .catch(error => {
          console.log(error)
          alert('Render table list Failed! Please try again')
        })
      } 
    )
    const clickAdd = (newUser) => {
      this.handleUpdate(newUser)
    };

    const clickEdit = (editProduct) => {
      // this.product = editProduct
      // console.log(editProduct)
      storeProduct.product = editProduct
    };

    const clickDelete = (deleteUser) => {
      // this.user = deleteUser
      // console.log(deleteUser)
    }
    const handleSearch = async (page = 1, paramsSearch) => {
      const response = await axios.get('products', { params: { ...paramsSearch, page } })
        .then(res => {
          const { data, meta } = res.data;

          // const data = res.data.data
          // const meta = res.data.meta

          this.products.value = data
          this.curPageProduct.value = meta.current_page
          this.fromProduct.value = meta.from
          this.toProduct.value = meta.to
          this.totalProduct.value = meta.total
          this.lastPageProduct.value = meta.last_page
          // console.log('data on start :', res.data)

        })
        .catch(error => {
          console.log(error)
          alert('Delete Search Failed! Please try again')
        })
    };
    const handleUpdate = async (paramsProduct) => {
      const response = await axios.post('product', paramsProduct)
        .then(res => { alert('Update success'); this.handleSearch() })
        .catch(error => { alert(error); console.log(error) })
    };

    return { paramsSearch, clickAdd, clickEdit, clickDelete, handleUpdate, handleSearch, product,products,
      curPageProduct,fromProduct,toProduct,totalProduct,lastPageProduct  }
  },

  // created() {
  //   this.handleSearch();
  // },
  methods: {



    // clearProduct() {
    //   this.product = {
    //     name: "",
    //     email: "",
    //     group: "",
    //     status: "",
    //   }
    // },

  },

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