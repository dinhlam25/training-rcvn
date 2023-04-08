<template>
    <!-- The Modal -->
    <div class="modal fade" id="ModalUpdateUser">
        <div class="modal-dialog">
            <div class="modal-content" style="background: darkgray;">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Information of User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="card-body">
                        <Form @submit.prevent="handleSubmit" :validation-schema="schema">

                            <div class="input-group form-group" style="margin-top: 10px;margin-bottom: 0 !important;" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 80px; background-color:#ffc107 ;">
                                        <p style="top: 20%;">Name </p>
                                    </span>
                                </div>
                                <Field name="name" v-model="userData.name" type="text" class="form-control" placeholder="Name" />
                            </div>
                            <ErrorMessage class="" name="name" style="left: 90px;color:red"/>

                            <div class="input-group form-group" style="margin-top: 10px;margin-bottom: 0 !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 80px; background-color:#ffc107 ;">
                                        <p style="top: 20%;">Email </p>
                                    </span>
                                </div>
                                <Field name="email"  v-model="userData.email" type="email" class="form-control" placeholder="Email" />
                            </div>
                            <ErrorMessage class="" name="email" style="left: 90px;color:red"/>

                            <div class="input-group form-group" style="margin-top: 10px;margin-bottom: 0 !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 80px; background-color:#ffc107 ;">
                                        <p style="top: 20%;">Group</p>
                                    </span>
                                </div>
                                <Field name="group" as="select" v-model="userData.group" class="form-control" style="height: auto;">
                                    <option value="">Chọn nhóm</option>
                                    <option value="admin">admin</option>
                                    <option value="editor">editor</option>
                                    <option value="reviewer">reviewer</option>
                                </Field>
                            </div>
                            <ErrorMessage class="" name="group" style="left: 90px;color:red"/>


                            <div class="input-group form-group" style="margin-top: 10px;margin-bottom: 0 !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 80px; background-color:#ffc107 ;">
                                        <p style="top: 20%;">Status </p>
                                    </span>
                                </div>
                                <Field name="status" as="select" v-model="userData.status" class="form-control" style="height: auto;">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="Đang hoạt động">Đang hoạt động</option>
                                    <option value="Tạm khóa">Tạm khóa</option>
                                </Field>
                            </div>
                            <ErrorMessage class="" name="status" style="left: 90px;color:red"/>
                            
                            <!-- Model footer -->
                            <div class="modal-footer d-flex justify-content-end">
                                <button v-if="this.userData.id" @click="handleOkUpdate" type="submit"
                                    class="btn btn-success" data-dismiss="modal"
                                    data-target="#ModalUpdateUser">Submit</button>
                                <button v-else @click="handleOkCreate" type="submit" class="btn btn-success"
                                    data-dismiss="modal" data-target="#ModalUpdateUser">Submit</button>

                                <button type="button" @click="noChange" class="btn btn-danger"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </Form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed } from 'vue';
import axios from 'axios';
import * as yup from 'yup';
import { Form, Field, ErrorMessage } from 'vee-validate';
export default {
    components: {
        Form, Field, ErrorMessage
    },
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
    setup() {
        const schema = yup.object({
            name: yup.string().required(),
            email: yup.string().required().email(),
            // password: yup.string().required().min(8),
            group: yup.string().required(),
            status: yup.string().required(),
        });
        return { schema }
    },
    methods: {
        handleSubmit() {
        },
        async handleUpdate() {
            // console.log(this.userData)
            const response = await axios.put('users/update', this.userData)
                .then(res => { alert('Update success'); this.$emit("update:reload") })
                .catch(error => { alert(error);this.noChange() })
        },

        handleOkCreate() {
            // console.log('create',this.userData)
            this.$emit("update:save", this.userData)
        },
        handleOkUpdate() {
            // console.log('update',this.userData)
            this.handleUpdate(this.userData)
        },
        // handleOk(){
        // console.log(this.userData.id)
        //     // this.$emit("update:save", this.userData)
        //     // this.handleUpdate(this.userData)

        // }
        noChange() {
            return this.userData = Object.assign({}, this.edit)
        }
    }
}
</script>