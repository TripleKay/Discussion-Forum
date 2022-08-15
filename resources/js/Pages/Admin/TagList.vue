<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="card border-0 bg-white" style="border-radius: 15px">
                    <div class="card-header  bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 py-2">Tag Lists -<div class="badge bg-secondary ms-2">{{ tagLists.length }}</div></h5>
                        <a href="" class="btn btn-primary btn-sm" title="Add Tag"><i class="fas fa-plus-circle"></i></a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tagList,index) in tagLists" :key="index">
                                    <td>{{ tagList.id }}</td>
                                    <td>{{ tagList.name }}</td>
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
        name: 'TagList',
        components: {
            AdminMaster,Link
        },
        data () {
            return {
                tagLists: '',
            }
        },
        created(){
            this.tagLists = this.$page.props.data;
        }
    }
</script>

<style  scoped>

</style>
