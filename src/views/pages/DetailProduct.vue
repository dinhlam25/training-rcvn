<template>
    <body>
        <div>
            <div class="d-flex ml-5 mr-5 mt-3">
                <h2>Chi tiết sản phẩm</h2>
                <RouterLink to="/dashboardProduct" class="ml-auto mt-3" style="font-size: large;">sản phẩm</RouterLink>
                <span class="ml-4 mt-3" style="font-size: large;"><strong>></strong></span>
                <span class="ml-4 mt-3" style="font-size: large;"> Chi tiết sản phẩm </span>
            </div>
            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background: #e8eaeb;">
                            <div class="card-body">
                                <!-- <div v-if=""></div> -->
                                <!-- <h4 class="card-title">Quản lí chi tiết sản phẩm</h4> -->
                                <!-- <p class="card-title-desc">Fill all information below</p> -->

                                <form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row mb-4">
                                                <label class="col-4" style="text-align: center;font-size: large;"
                                                    for="productname"><strong>Tên sản phẩm</strong></label>
                                                <input v-model="product.product_name" id="productname" name="productname" placeholder="Nhập tên sản phẩm"
                                                    type="text" class="col-8 form-control">
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-4" style="text-align: center;font-size: large;"
                                                    for="price"><strong>Giá bán</strong></label>
                                                <input v-model="product.product_price" id="price" name="price" type="text" placeholder="Nhập giá bán"
                                                    class="col-8 form-control">
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-4" style="text-align: center;font-size: large;"
                                                    for="productdesc"><strong>Mô tả</strong></label>
                                                <textarea v-model="product.description" placeholder="Mô tả sản phẩm" class="col-8 form-control"
                                                    id="productdesc" rows="5"></textarea>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="control-labelstrong col-4"
                                                    style="text-align: center;font-size: large;"><strong>Trạng
                                                        thái</strong></label>
                                                <select v-model="product.is_sales" class="form-control select2 col-8">
                                                    <option>Chọn trạng thái</option>
                                                    <option value="0">Ngừng bán</option>
                                                    <option value="-1">Hết hàng</option>
                                                    <option value="1">Đang bán</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><strong>Hình ảnh</strong></label> <br />
                                                <!-- <img src="assets/images/products/1.jpg" alt="product img" -->
                                                <img src="" alt="product img"
                                                    class="img-fluid rounded" style="max-width: 200px;" />
                                                <br />
                                                <div class="d-flex">
                                                    <button type="button"
                                                        class="btn btn-info mt-2 mr-2 waves-effect waves-light">Upload</button>
                                                    <button type="button"
                                                        class="btn btn-danger mt-2  waves-effect waves-light">Xóa
                                                        File</button>
                                                    <input type="text" placeholder="tên file upload" style="height: auto;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mr-5 pr-5">
                                        <button type="submit" class="btn btn-success mr-1 waves-effect waves-light ">Lưu
                                            thay đổi</button>
                                        <button type="submit" class="btn btn-danger waves-effect ml-2">Hủy</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </body></template>
<script setup>
import { useProduct } from '@/stores/useProduct'
import { reactive, ref, onMounted } from 'vue'
const storeProduct = useProduct();

const product  = reactive({product_id: "", product_name: "", product_price: "", description: "", is_sales: "" });
onMounted(
    () => {
        product.product_id = storeProduct.product.product_id
        product.product_name = storeProduct.product.product_name
        product.product_price = storeProduct.product.product_price
        product.description = storeProduct.product.description
        product.is_sales = storeProduct.product.is_sales === "Ngừng bán"? -1 : (storeProduct.product.is_sales === "Hết hàng" ? 0 : 1)
    }
)


</script>
<style>body {
    background: #e8eaeb;
}</style>

