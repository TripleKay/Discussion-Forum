<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="bg-white border-0 card" style="border-radius: 15px">
                    <div class="bg-transparent card-header d-flex justify-content-between align-items-center">
                        <h5 class="py-2 mb-0">Question Lists -<div class="badge bg-secondary ms-2">{{ questionLists.length }}</div></h5>

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
                                <tr v-for="(questionList,index) in questionLists" :key="index">
                                    <td>{{ questionList.id }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <img :src="'/uploads/users/'+questionList.user.image" class="rounded-circle" alt="" srcset="" style="width: 35px ; height: 35px;">
                                            <div class="ms-2">
                                                <h6 class="mb-0 text-nowrap">{{ questionList.user.name}}</h6>
                                                <span class="text-black-50">{{ questionList.time }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ questionList.title.substring(0,80) }}</td>
                                    <td>{{ questionList.description.substring(0,100) }}.....</td>
                                    <td>{{ questionList.comment.length }} comments</td>
                                    <td class="text-nowrap">
                                        <Link :href="route('admin.showQuestion',questionList.slug)" class="btn btn-outline-info btn-sm me-2"><i class="fas fa-eye"></i></Link>
                                        <button @click="deleteQuestion(index,questionList.id)" class="btn btn-outline-danger btn-sm me-2"><i class="fas fa-trash"></i></button>
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
        name: 'QuestionList',
        components: {
            AdminMaster,Link
        },
        data () {
            return {
                questionLists: '',
            }
        },
        methods: {
            deleteQuestion(index,id){

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete question!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        //delete tag
                         axios.get(this.route('admin.deleteQuestion',id)).then((response) => {
                            if(response.data.success){
                                //alert
                                Swal.fire(
                                'Deleted!',
                                'Question has been deleted.',
                                'success'
                                )
                                this.questionLists.splice(index,1);
                                }
                        })

                    }
                    })

            }
        },
        created(){
            this.questionLists = this.$page.props.data;
        }
    }
</script>

<style  scoped>

</style>
