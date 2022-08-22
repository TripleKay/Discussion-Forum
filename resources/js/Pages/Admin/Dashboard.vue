<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="bg-white border-0 card" style="border-radius: 15px">
                    <div class="bg-transparent card-header ">
                        <h5 class="py-2 mb-0">Dashboard</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="card" style="border-radius: 10px;">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="p-3 bg-secondary d-inline-block" style="border-radius: 10px;">
                                            <i class="mb-0 text-white fas fa-users h4"></i>
                                        </div>
                                        <div class="ms-2">
                                            <h5 class="mb-1">Total Users</h5>
                                            <p class="mb-0">{{userCount}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" style="border-radius: 10px;">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="p-3 bg-secondary d-inline-block" style="border-radius: 10px;">
                                            <i class="mb-0 text-white fas fa-question-circle h4"></i>
                                        </div>
                                        <div class="ms-2">
                                            <h5 class="mb-1">Total Questions</h5>
                                            <p class="mb-0">{{ questions.length }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-4">
                                <div class="card" style="border-radius: 10px;">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="p-3 bg-secondary d-inline-block" style="border-radius: 10px;">
                                            <i class="mb-0 text-white fas fa-hashtag h4"></i>
                                        </div>
                                        <div class="ms-2">
                                            <h5 class="mb-1">Total Tags</h5>
                                            <p class="mb-0">{{ tagCount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  <div class="mt-3 bg-white border-0 card" style="border-radius: 15px">
                    <div class="bg-transparent card-header d-flex justify-content-between align-items-center">
                        <h5 class="py-2 mb-0">Lastest Questions</h5>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>Author</th>
                                    <th scope="col">Name</th>
                                    <th>Description</th>
                                    <th>Comment</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(question,index) in questions" :key="index">
                                    <td>{{ question.id }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <img :src="'/uploads/users/'+question.user.image" class="rounded-circle" alt="" srcset="" style="width: 35px ; height: 35px;">
                                            <div class="ms-2">
                                                <h6 class="mb-0 text-nowrap">{{ question.user.name}}</h6>
                                                <span class="text-black-50">{{ question.time }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ question.title.substring(0,80) }}</td>
                                    <td>{{ question.description.substring(0,100) }}.....</td>
                                    <td>{{ question.comment.length }} comments</td>
                                    <td class="text-nowrap">
                                        <Link :href="route('admin.showQuestion',question.slug)" class="btn btn-outline-info btn-sm me-2"><i class="fas fa-eye"></i></Link>
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
        name: 'Dashboard',
        components: {
            AdminMaster,Link
        },
        data () {
            return {
                userCount: '',
                tagCount: '',
                questions: '',
            }
        },
        created(){
            this.userCount = this.$page.props.users;
            this.tagCount = this.$page.props.tags;
            this.questions = this.$page.props.questions;
        }
    }
</script>

<style  scoped>

</style>
