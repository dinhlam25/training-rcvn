<template>
    <!-- The Modal -->
    <div class="modal fade" id="ModalUpdateUser">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Information of User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="card-body">
                        <form @submit.prevent="handleSubmit">

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: auto;">
                                        <p>Name</p>
                                    </span>
                                </div>
                                <input v-model="userData.name" type="text" class="form-control" placeholder="Name">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: auto;">
                                        <p>Email</p>
                                    </span>
                                </div>
                                <input v-model="userData.email" type="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: auto;">
                                        <p>Group</p>
                                    </span>
                                </div>
                                <select v-model="userData.group" class="form-control" style="height: auto;">
                                    <option value="">Chọn nhóm</option>
                                    <option value="admin">admin</option>
                                    <option value="editor">editor</option>
                                    <option value="reviewer">reviewer</option>
                                </select>
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: auto;">
                                        <p>Status</p>
                                    </span>
                                </div>
                                <select v-model="userData.status" class="form-control" style="height: auto;">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="Active">Đang hoạt động</option>
                                    <option value="Lock">Tạm khóa</option>
                                </select>
                            </div>
                            <!-- Model footer -->
                            <div class="modal-footer d-flex justify-content-end">
                                <button v-if="this.userData.id" @click="handleOkUpdate" type="submit" class="btn btn-success"
                                    data-dismiss="modal" data-target="#ModalUpdateUser">Submit</button>
                                <button v-else @click="handleOkCreate" type="submit" class="btn btn-success"
                                    data-dismiss="modal" data-target="#ModalUpdateUser">Submit</button>
                                <!-- <button @click="handleOkUpdate" type="submit" class="btn btn-success"
                                    data-dismiss="modal" data-target="#ModalUpdateUser">Submit</button> -->
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed } from 'vue';
import axios from 'axios';
export default {
    props: {
        edit: {
            typeof: Object,
            default: null
        },

    },
    watch: {
        edit() {
            if (this.edit) {
                this.userData = Object.assign({}, this.edit)
            } else {
                this.userData = {}
            }
        },

    },
    data() {
        return {
            userData: {
                name: "",
                email: "",
                group: "",
                status: "",
            }
        }
    },
    methods: {
        handleSubmit() {
        },
        async handleUpdate() {
            // console.log(this.userData)
            const response = await axios.put('users/update', this.userData)
                .then(res => { alert('Update success'); this.$emit("update:reload") })
                .catch(error => { alert(error); })
        },

        handleOkCreate() {
            console.log('create',this.userData)
            this.$emit("update:save", this.userData)
        },
        handleOkUpdate() {
            console.log('update',this.userData)
            this.handleUpdate(this.userData)
        },
        // handleOk(){
            // console.log(this.userData.id)
        //     // this.$emit("update:save", this.userData)
        //     // this.handleUpdate(this.userData)

        // }
    }
}
</script>