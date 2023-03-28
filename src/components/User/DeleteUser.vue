<template>
    <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalStatus">
    Launch demo modal
  </button> -->
  
  <!-- Modal -->
  <div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Do you want to delete user ID: <strong>{{ this.userData.id }}</strong> with Name: <strong>{{ this.userData.name }}</strong> ?
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
          userData:{
              typeof: Object,
              default: null
          },
      },
      methods: {
          async handleOkDelete() {
              const response = await axios.delete('users/'+this.userData.id+'/delete', this.userData)
                  .then(res => { alert('Update Status success'); this.$emit("update:reload") })
                  .catch(error => { alert(error); })
          },
      }
  }
  </script>
  
  <style>
  
  </style>