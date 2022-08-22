<template>
    <div>
        <!-- ------------nav bar----------------  -->
        <Nav></Nav>

        <Toast v-if="this.$page.props.flash.message != null" :icon="'success'" :title="this.$page.props.flash.message"></Toast>

        <!-- ------------content---------------  -->
        <div class="container-fluid min-vh-100 bg-light" style="">
            <div class="container">
                <div class="py-5 row">
                    <!-- ------------tags---------------  -->
                    <div class="col-12">
                        <AdminSideBar></AdminSideBar>
                    </div>
                    <!-- ------------content---------------  -->
                    <div class="col-12">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Nav from "../../Layouts/Nav.vue";
import AdminSideBar from "../Layouts/AdminSideBar.vue";
import { Link } from '@inertiajs/inertia-vue3';
import Toast from '../../Components/SuccessAlert.vue'
    export default {
        name: 'AdminMaster',
        components: {
            Nav,Link,AdminSideBar,Toast
        },
    }
</script>

<style  scoped>

</style>
