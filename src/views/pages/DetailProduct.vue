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
                                <h3 v-if="storeProduct.product" class="card-title mb-3" style="text-align: center;">Cập nhật
                                    sản phẩm</h3>
                                <h3 v-else class="card-title mb-" style="text-align: center;">Thêm sản phẩm</h3>
                                <!-- <p class="card-title-desc">Fill all information below</p> -->

                                <Form @submit="handleSubmit" :validation-schema="simpleSchema">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row mb-4">
                                                <label class="col-4" style="text-align: center;font-size: large;"
                                                    for="productname"><strong>Tên sản phẩm</strong></label>
                                                <Field v-model="product.product_name" id="productname" name="name"
                                                    placeholder="Nhập tên sản phẩm" type="text"
                                                    class="col-8 form-control" />
                                                <ErrorMessage name="name" class="errorMess" />

                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-4" style="text-align: center;font-size: large;"
                                                    for="price"><strong>Giá bán</strong></label>
                                                <Field v-model="product.product_price" id="price" name="price" type="text"
                                                    placeholder="Nhập giá bán" class="col-8 form-control" />
                                                <ErrorMessage name="price" class="errorMess" />

                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-4" style="text-align: center;font-size: large;"
                                                    for="productdesc"><strong>Mô tả</strong></label>
                                                <textarea v-model="product.description" placeholder="Mô tả sản phẩm"
                                                    class="col-8 form-control" id="productdesc" rows="5"></textarea>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="control-labelstrong col-4"
                                                    style="text-align: center;font-size: large;"><strong>Trạng
                                                        thái</strong></label>
                                                <select v-model="product.is_sales" class="form-control select2 col-8">
                                                    <option>Chọn trạng thái</option>
                                                    <option value="-1">Ngừng bán</option>
                                                    <option value="0">Hết hàng</option>
                                                    <option value="1">Đang bán</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group pl-5">
                                                <div style="text-align: center;">
                                                    <label style="font-size:x-large;"><strong>Hình ảnh sản
                                                            phẩm</strong></label>
                                                </div>
                                                <!-- <img src="assets/images/products/1.jpg" alt="product img" -->

                                                <br />
                                                <!-- <div class="d-flex">
                                                    <button type="button"
                                                        class="btn btn-info mt-2 mr-2 waves-effect waves-light">Upload <input type="file" name="" id=""></button>
                                                    <button type="button"
                                                        class="btn btn-danger mt-2  waves-effect waves-light">Xóa
                                                        File</button>
                                                    <input type="text" placeholder="tên file upload" style="height: auto;">
                                                </div> -->
                                                <div>
                                                    <UploadFile />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mr-5 pr-5">
                                        <button v-if="storeProduct.product" @click="handleSubmitUpdate" type="submit"
                                            class="btn btn-success mr-1 waves-effect waves-light ">Cập nhật</button>
                                        <button v-else @click="handleSubmitCreate" type="submit"
                                            class="btn btn-success mr-1 waves-effect waves-light ">Thêm sản phẩm</button>
                                        <button type="submit" class="btn btn-danger waves-effect ml-2">Hủy</button>
                                    </div>
                                </Form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </body>
</template>
<script setup>
import { useProduct } from '@/stores/useProduct'
import axios from 'axios';
import { reactive, ref, onMounted } from 'vue'
import { Form, Field, ErrorMessage } from 'vee-validate';
import UploadFile from '../../components/Product/UploadFile.vue';

const storeProduct = useProduct();
const product = reactive({ product_id: "", product_name: "", product_image: "", product_price: "", description: "", is_sales: "" });
onMounted(
    () => {


        if (storeProduct.product !== null) {
            product.product_id = storeProduct.product.product_id
            product.product_name = storeProduct.product.product_name
            product.product_image = storeProduct.product.product_image
            product.product_price = storeProduct.product.product_price
            product.description = storeProduct.product.description
            product.is_sales = storeProduct.product.is_sales === "Ngừng bán" ? -1 : (storeProduct.product.is_sales === "Hết hàng" ? 0 : 1)
            // console.log('info case', product)

        }
        else {
            product.product_id = null
            product.product_name = null
            product.product_image = null
            product.product_price = null
            product.description = null
            product.is_sales = null
            // console.log('empty case', product)
        }
    }
)
const handleSubmit = () => { console.log('Đã submit') }
const test = () => {
    console.log(product)
}
const handleSubmitCreate = async () => {

    const params = {
        'product_name': product.product_name,
        'product_price': product.product_price,
        'product_image': product.product_image,
        'description': product.description,
        'is_sales': product.is_sales
    }

    const response = await axios.post('products', params)
        .then(res => { alert('Create success'); })
        .catch(error => { alert(error); console.log(error) })
}

const handleSubmitUpdate = async () => {

    // const reader = new FileReader()

    // let rawImg;
    // reader.onloadend = () => {
    //     rawImg = reader.result;
    //     console.log(rawImg);
    // }
    // reader.readAsDataURL(storeProduct.product.product_image);


    // console.log(storeProduct.product.product_image)
    // console.log(storeProduct.product)

    product.product_image = storeProduct.product.product_image
    console.log(product.product_image)
    const response = await axios.post('products/' + product.product_id, product)
        .then(res => { alert('Update success'); console.log('product_image') })
        .catch(error => { alert(error); })
}

const simpleSchema = {
    name(value) {
        if (!value) {
            return 'Tên sản phẩm không được để trống'
        }
        if (value.length <= 5) {
            return 'Tên sản phẩm phải lớn hơn 5 ký tự'
        }
        if (value)
            return ''
    },
    price(value) {
        if (!value) {
            return 'Giá sản phẩm không được để trống'
        }
        // const regex = /^[1-9][0-9]*$/;
        const regex = /^(0*[1-9][0-9]*(\.[0-9]+)?|0+\.[0-9]*[1-9][0-9]*)$/;

        if (!regex.test(value)) {
            return 'Giá sản phẩm phải là số và lớn hơn 0'
        }
        if (value)
            return ''
    }

}

</script>
<style>
body {
    background: #e8eaeb;
}

.errorMess {
    color: red;
    margin-left: 16em;
    font-size: large;
}
</style>

