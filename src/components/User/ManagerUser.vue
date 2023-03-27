<template>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
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
                                <input v-model="user.name" type="text" class="form-control" placeholder="Name">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: auto;">
                                        <p>Email</p>
                                    </span>
                                </div>
                                <input v-model="user.email" type="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: auto;">
                                        <p>Group</p>
                                    </span>
                                </div>
                                <select v-model="user.group" class="form-control" style="height: auto;">
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
                                <select v-model="user.status" class="form-control" style="height: auto;">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="Active">Đang hoạt động</option>
                                    <option value="Lock">Tạm khóa</option>
                                </select>
                            </div>
                            <!-- Model footer -->
                            <div class="modal-footer d-flex justify-content-end">
                                <button @click="handleOK" type="submit" class="btn btn-success"
                                    data-dismiss="modal">Submit</button>
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
export default {
    setup() {

    },
    props: {
        edit: {
            typeof: Object,
            default: null
        }
    },
    watch: {
        edit() {
            if (this.edit) {
                this.user = Object.assign({}, this.edit)
            } else {
                this.user = {}
            }
        },

    },
    data() {
        return {
            // user: {
            //     // id: Math.floor(Math.random() * 1000),
            //     name: "",
            //     email: "",
            //     group: "",
            //     // lastLogin : now(),
            //     status: "",
            // }
            user: {}
        }
    },
    methods: {
        handleSubmit() {

        },
        async handleOK() {
            console.log('111')
            const response = await axios.post('auth/updateByRoot', this.user)
                .then(res => { alert('Submit success'); this.handleSearch() })
                .catch(error => alert(error))
        },

        // handleOK() {
        //     console.log(this.user)
        //     this.handleUpdate(this.user)
        //     this.$emit("save", this.user)
        //     this.user = {
        //         // id: Math.floor(Math.random() * 1000),
        //         name: "",
        //         email: "",
        //         group: "",
        //         // lastLogin : now(),
        //         status: "",
        //     }
        // }

    }
}
</script>