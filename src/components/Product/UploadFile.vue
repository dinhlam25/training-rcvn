<script setup>
import { reactive, watch } from 'vue';
import { useDropzone } from 'vue3-dropzone';
import { useProduct } from '@/stores/useProduct'

const storeProduct = useProduct();

const state = reactive({
    files: [],
});

const { getRootProps, getInputProps, isDragActive, ...rest } = useDropzone({
    onDrop,
});

watch(state, () => {
    // console.log('state', state);
});

watch(isDragActive, () => {
    console.log('isDragActive', isDragActive.value, rest);
});

function onDrop(acceptFiles, rejectReasons) {
    //   console.log('acceptFiles',acceptFiles);
    //   console.log('rejectReasons',rejectReasons);
    state.files = acceptFiles;
    storeProduct.product.product_image = acceptFiles;
    console.log('sau tai anh storeProduct',storeProduct.product)
    // console.log('files', state.files[0]);
}

function handleClickDeleteFile(index) {
    state.files.splice(index, 1);
    storeProduct.product.product_image = state.files[0]
}
</script>

<template>
    <div>
        <div v-if="state.files.length > 0" class="files">
            <div class="file-item" v-for="(file, index) in state.files" :key="index">
                <!-- <div class="file-item"> -->
                <span>{{ file.name }}</span>
                <span class="delete-file" @click="handleClickDeleteFile(index)">Delete</span>
            </div>
        </div>
        <div v-else class="dropzone" v-bind="getRootProps()">
            <div class="border" :class="{
                isDragActive,
            }">
                <input v-bind="getInputProps()" />
                <p v-if="isDragActive">Drop the files here ...</p>
                <p v-else>Drag and drop files here, or Click to select files</p>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.dropzone,
.files {
    width: 100%;
    max-width: 300px;
    margin: 0 auto;
    padding: 10px;
    border-radius: 8px;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
        rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
    font-size: 12px;
    line-height: 1.5;
}

.border {
    border: 2px dashed #ccc;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    transition: all 0.3s ease;
    background: #fff;

    &.isDragActive {
        border: 2px dashed #ffb300;
        background: rgb(255 167 18 / 20%);
    }
}

.file-item {
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgb(255 167 18 / 20%);
    padding: 7px;
    padding-left: 15px;
    margin-top: 10px;

    &:first-child {
        margin-top: 0;
    }

    .delete-file {
        background: red;
        color: #fff;
        padding: 5px 10px;
        border-radius: 8px;
        cursor: pointer;
    }
}
</style>
