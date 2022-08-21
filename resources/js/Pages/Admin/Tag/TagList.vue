<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="bg-white border-0 card" style="border-radius: 15px">
                    <div class="bg-transparent card-header d-flex justify-content-between align-items-center">
                        <h5 class="py-2 mb-0">Tag Lists -<div class="badge bg-secondary ms-2">{{ tagLists.length }}</div></h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTagModal">
                        <i class="fas fa-plus-circle"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="#addTagModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="#addTagModal">Add new Tag</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="">
                                    <label class="form-label">Tag Name</label>
                                    <input type="text" class="form-control" v-model="name" placeholder="enter tag name" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary " id="close" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="createTag">Add Tag</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tagList,index) in tagLists" :key="index">
                                    <td>{{ tagList.id }}</td>
                                    <td>{{ tagList.name }}</td>
                                    <td>{{ tagList.question_count }}</td>
                                    <td>
                                        <button @click="deleteTag(index,tagList.id)" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
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
import AdminMaster from "../Layouts/AdminMaster.vue";
import { Link } from '@inertiajs/inertia-vue3';

export default {
        name: 'TagList',
        components: {
            AdminMaster,Link
        },
        data () {
            return {
                tagLists: '',
                name: '',

            }
        },
        methods: {
            hideModal(){
                 document.getElementById('close').click();
            },
            createTag () {
                var data = new FormData;
                data.append('name',this.name);
                axios.post(this.route('admin.createTag'),data).then((response) => {
                        if(response.data.success){
                            this.hideModal();
                            this.tagLists.push(response.data.tag);
                            this.name = '';
                            Toast.fire({
                                icon: 'success',
                                title: 'Tag created successfully',
                            });
                        }
                    })
            },
            deleteTag(index,id){
                //alert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        //delete tag
                         axios.get(this.route('admin.deleteTag',id)).then((response) => {
                            if(response.data.success){
                                this.tagLists.splice(index,1);
                                }
                        })
                        //alert
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                    })

            }
        },
        created(){
            this.tagLists = this.$page.props.data;
        }
    }
</script>

<style  scoped>

</style>
