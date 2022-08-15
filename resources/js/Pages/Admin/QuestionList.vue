<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="card border-0 bg-white" style="border-radius: 15px">
                    <div class="card-header  bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 py-2">Question Lists -<div class="badge bg-secondary ms-2">{{ questionLists.length }}</div></h5>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>Author</th>
                                    <th scope="col">Name</th>
                                    <th>Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(questionList,index) in questionLists" :key="index">
                                    <td>{{ questionList.id }}</td>
                                    <td>{{ questionList.user.name }}</td>
                                    <td>{{ questionList.title.substring(0,80) }}</td>
                                    <td>{{ questionList.description.substring(0,100) }}.....</td>
                                    <td>
                                        <a href="" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
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
        name: 'QuestionList',
        components: {
            AdminMaster,Link
        },
        data () {
            return {
                questionLists: '',
            }
        },
        created(){
            this.questionLists = this.$page.props.data;
        }
    }
</script>

<style  scoped>

</style>
