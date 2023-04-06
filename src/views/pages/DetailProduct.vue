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
                                            <div class="form-group pl-2">
                                                <div class="" style="text-align: ;">
                                                    <label style="font-size:x-large;"><strong>Hình ảnh sản
                                                            phẩm</strong></label>
                                                </div>
                                                <div v-if="url">
                                                    <img :src="url" class="row ml-5 mb-1 " alt="ảnh sản phẩm"
                                                        style="width: 220px; height: 220px;">
                                                </div>

                                                <div v-else-if="product.product_image">
                                                    <img :src="product.product_image" class="row ml-5 mb-1 "
                                                        alt="ảnh sản phẩm" style="width: 220px; height: 220px;">
                                                </div>

                                                <div v-else class="">
                                                    <img src="https://png.pngtree.com/png-vector/20190223/ourlarge/pngtree-gallery-glyph-black-icon-png-image_691548.jpg"
                                                        alt="ảnh sản phẩm" class="row ml-5 mb-1" style="width: 220px;">
                                                </div>

                                                <div class="mt-3">
                                                    <button type="submit" v-bind="getRootProps()"
                                                        class="btn btn-info ml-5 mr-1 waves-effect waves-light ">Upload</button>
                                                    <button type="submit" @click="handleClickDeleteFile()"
                                                        class="btn btn-danger waves-effect ml-2">Xóa file</button>
                                                    <!-- input file handle -->
                                                    <input v-bind="getInputProps()" />
                                                    <input v-if="state.files[0]" type="text" disabled
                                                        :placeholder="state.files[0].name" class="ml-2"
                                                        style="height: 37px;">
                                                    <input v-else-if="product.product_image" type="text" disabled
                                                        :placeholder="product.product_image.slice(-10)" class="ml-2"
                                                        style="height: 37px;">
                                                    <input v-else type="text" disabled placeholder="Ten file" class="ml-2"
                                                        style="height: 37px;">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mr-5 pr-5">
                                        <button v-if="storeProduct.product" @click="handleSubmitUpdate" type="submit"
                                            class="btn btn-success mr-1 waves-effect waves-light ">Cập nhật</button>
                                        <button v-else @click="handleSubmitCreate" type="submit"
                                            class="btn btn-success mr-1 waves-effect waves-light ">Thêm sản phẩm</button>
                                        <button type="submit" @click="backToProductPage"
                                            class="btn btn-danger waves-effect ml-2">Hủy</button>
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
import { reactive, watch, ref, onMounted, onBeforeMount } from 'vue'
import { Form, Field, ErrorMessage } from 'vee-validate';
import FormData from 'form-data'
import { useDropzone } from 'vue3-dropzone';
import { useRouter } from 'vue-router'


const router = useRouter()
// upload file by dropzone start
const state = reactive({
    files: [],
});
const url = ref(null)
const inputFileName = ref(null)
const { getRootProps, getInputProps, isDragActive, ...rest } = useDropzone({
    onDrop,
});
watch(isDragActive, () => {
    console.log('isDragActive', isDragActive.value, rest);
});
// upload file by dropzone end

const storeProduct = useProduct();
const product = reactive({ product_id: "", product_name: "", product_image: "", product_price: "", description: "", is_sales: "" });
onBeforeMount
    (
        () => {
        }
    )
onMounted(
    () => {
        if (storeProduct.product !== null) {
            product.product_id = storeProduct.product.product_id
            product.product_name = storeProduct.product.product_name
            product.product_image = storeProduct.product.product_image
            product.product_price = storeProduct.product.product_price
            product.description = storeProduct.product.description
            product.is_sales = storeProduct.product.is_sales === "Ngừng bán" ? -1 : (storeProduct.product.is_sales === "Hết hàng" ? 0 : 1)
        }
        else {
            product.product_id = null
            product.product_name = null
            product.product_image = null
            product.product_price = null
            product.description = null
            product.is_sales = null
        }
        url.value = null

    }
)
const handleSubmit = () => { }

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
// 
const handleSubmitUpdate = async () => {

    product.product_image = storeProduct.product.product_image
    const formData = new FormData();

    for (const [key, value] of Object.entries(product)) {
        formData.append(key, product[key])
    }

    const response = await axios.post('products/' + product.product_id, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(res => { alert('Update success'); router.push('/dashboardProduct'); })
        .catch(error => { alert(error); })
};

function onDrop(acceptFiles, rejectReasons) {
    state.files = acceptFiles;
    if (acceptFiles) {
        storeProduct.product.product_image = acceptFiles[0]
        url.value = URL.createObjectURL(acceptFiles[0])
    } else {
        storeProduct.product.product_image = null
    }
};
function handleClickDeleteFile() {
    // state.files.splice(index, 1);
    storeProduct.product.product_image = null
    state.files[0] = null
    product.product_image = null
    url.value = null
};
function backToProductPage() {
    router.push('/dashboardProduct');
};

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

