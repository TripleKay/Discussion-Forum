<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="card border-0 bg-white">
                    <div class="card-header  bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 py-2">User Lists</h5>
                        <a href="" class="btn btn-primary" title="Add User"><i class="fas fa-plus-circle"></i></a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(userList,index) in userLists" :key="index">
                                    <td>{{ userList.id }}</td>
                                    <td>{{ userList.name }}</td>
                                    <td>{{ userList.email}}</td>
                                    <td>
                                        <a href="" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
        </AdminMaster>
    </div>
</template>

<script>
import AdminMaster from "./Layouts/AdminMaster.vue"
import { Link } from '@inertiajs/inertia-vue3'

    export default {
        name: 'UserList',
        components: {
            AdminMaster,Link
        },
        data () {
            return {
                userLists: '',
            }
        },
        created(){
            this.userLists = this.$page.props.data;
        }
    }
</script>

<style  scoped>

</style>
