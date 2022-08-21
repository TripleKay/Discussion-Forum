<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <div class="bg-white border-0 card">
                    <div class="bg-transparent card-header d-flex justify-content-between align-items-center">
                        <h5 class="py-2 mb-0">Dashboard</h5>
                        <a href="" class="btn btn-primary" title="Add User"><i class="fas fa-plus-circle"></i></a>
                    </div>
                    <div class="card-body">
                       
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
