<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="mb-4 bg-white border-0 card" style="border-radius: 15px">
                    <div class="bg-transparent card-header d-flex justify-content-between align-items-center">
                        <h5 class="py-2 mb-0">Edit {{ user.name }}</h5>
                    </div>
                     <div class="card-body">
                    <form @submit.prevent="updateProfile">
                        <img :src="'/uploads/users/'+user.image" class="rounded-circle" alt="" srcset="" style="width: 100px; height: 100px">
                        <div class="my-3">
                            <label for="" class="form-label">Change Profile Photo</label>
                            <input type="file" class="form-control" id="newImage" @change="selectImage"  style="border-radius: 15px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" v-model="name"  style="border-radius: 15px;">
                             <small class="text-danger" v-if="errors.name">{{ errors.name }}</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" v-model="email"  style="border-radius: 15px;">
                             <small class="text-danger" v-if="errors.email">{{ errors.email }}</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label" >Role</label>
                            <select name="" id="" class="form-control" style="border-radius: 15px;" v-model="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                             <small class="text-danger" v-if="errors.role">{{ errors.role }}</small>
                        </div>
                        <div class="mt-4 d-flex align-items-center float-end">
                            <button class="btn btn-primary " :disabled="loading">
                                <div v-show="loading" class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span v-show="loading">wait...</span>
                                <span v-show="!loading">Update User</span>
                            </button>
                        </div>
                    </form>
                </div>
                </div>
        </AdminMaster>
    </div>
</template>

<script>
import AdminMaster from "../Layouts/AdminMaster.vue"
import { Link } from '@inertiajs/inertia-vue3'

    export default {
        name: 'EditUser',
        components: {
            AdminMaster,Link
        },
        data () {
            return {
                user: '',
                name: '',
                email: '',
                role: '',
                newImage: '',
                loading: false,
            }
        },
        props: {
            errors: Object
        },
        methods: {
            selectImage (e) {
                this.newImage = e.target.files[0];
            },
            updateProfile(){
                this.loading = true;
                var data = new FormData;
                data.append('name',this.name);
                data.append('email',this.email);
                data.append('role',this.role);
                data.append('newImage',this.newImage);
                this.$inertia.post(this.route('admin.updateUser',this.user.id), data ,{
                    onFinish: () => this.loading = false
                });
            },
            loadUserData(){
                this.name = this.user.name;
                this.email = this.user.email;
                this.role = this.user.role;
            },
        },
        created(){
            this.user = this.$page.props.user;
            this.loadUserData();
        }
    }
</script>

<style  scoped>

</style>
