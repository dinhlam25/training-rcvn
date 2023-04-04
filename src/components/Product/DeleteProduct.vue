<template>
    <!-- Modal -->
    <div  class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background: antiquewhite;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Bạn có muốn xóa Product ID: <strong>{{ this.productData.product_id }}</strong> with Name: <strong>{{ this.productData.product_name }}</strong> ?
          <!-- {{ this.productData }} -->
        </div>
        <div class="modal-footer">
            <button @click="handleOkDelete" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  export default {
      props: {
          productData:{
              typeof: Object,
              default: null
          },
      },
      methods: {
          async handleOkDelete() {
                console.log(this.productData.product_id)
              const response = await axios.delete('products/'+this.productData.product_id)
                  .then(res => { alert('Delete success'); this.$emit("update:reload") })
                  .catch(error => { alert(error); })
          },
      }
  }
  </script>

<style>

</style>