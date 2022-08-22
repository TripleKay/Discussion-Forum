<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="bg-white border-0 card" style="border-radius: 15px">
                    <div class="bg-transparent card-header d-flex justify-content-between align-items-center">
                        <h5 class="py-2 mb-0">User Lists -<div class="badge bg-secondary ms-2">{{ userLists.length }}</div></h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th>Role</th>
                                    <th>Questions</th>
                                    <th>Comment</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(userList,index) in userLists" :key="index">
                                    <td>{{ userList.id }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <img :src="'/uploads/users/'+userList.image" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                                            <div class="ms-2">
                                                <h6 class="mb-0 text-nowrap">{{ userList.name}}</h6>
                                                <span v-if="$page.props.auth_user.id == userList.id" class="text-success fw-bold">You</span>
                                                <span v-else class="text-black-50">{{ userList.role }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ userList.email}}</td>
                                    <td><div class="fw-bold" :class="userList.role == 'admin' ? 'text-danger' : '' ">{{ userList.role}}</div></td>

                                    <td>{{ userList.question.length }}</td>
                                    <td>{{ userList.comment.length }}</td>
                                    <td>
                                        <button v-show="userList.id != $page.props.auth_user.id"  @click="deleteUser(index,userList.id)" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        <Link :href="route('admin.editUser',userList.id)" class="btn btn-outline-success btn-sm ms-2"><i class="fas fa-edit"></i></Link>
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
import AdminMaster from "../Layouts/AdminMaster.vue"
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
        methods: {
            deleteUser(index,id){

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete User!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        //delete tag
                         axios.get(this.route('admin.deleteUser',id)).then((response) => {
                            if(response.data.success){
                                this.userLists.splice(index,1);
                                }
                        })
                        //alert
                        Swal.fire(
                        'Deleted!',
                        'User has been deleted.',
                        'success'
                        )
                    }
                    })

            }
        },
        created(){
            this.userLists = this.$page.props.data;
        }
    }
</script>

<style  scoped>

</style>
