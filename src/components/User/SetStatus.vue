<template>
  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalStatus">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="ModalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Status User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you want to change status of <strong>{{ this.userData.name }}</strong> from 
        <strong>{{ this.userData.status }}</strong> to <strong>{{ this.userData.status === 'Active'? 'Lock':'Active' }}</strong>?
      </div>
      <div class="modal-footer">
          <button @click="handleOkUpdate" type="button" class="btn btn-success" data-dismiss="modal">Save changes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
        async handleOkUpdate() {
            this.userData.status === 'Active'? this.userData.status='Lock':this.userData.status='Active'
            const response = await axios.put('users/update/status', this.userData)
                .then(res => { alert('Update Status success'); this.$emit("update:reload") })
                .catch(error => { alert(error); })
        },
    }
}
</script>

<style>

</style>