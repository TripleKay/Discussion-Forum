<template>
    <div>
        <!-- ------------nav bar----------------  -->
        <Nav></Nav>
        <!-- ------------content---------------  -->
        <div class="container-fluid min-vh-100 bg-light" style="">
            <div class="container">
                <div class="row py-5">
                    <!-- ------------tags---------------  -->
                    <div class="col-12 col-md-3">
                        <AdminSideBar></AdminSideBar>
                    </div>
                    <!-- ------------content---------------  -->
                    <div class="col-12 col-md-9">
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
import { Link } from '@inertiajs/inertia-vue3'

    export default {
        name: 'AdminMaster',
        components: {
            Nav,Link,AdminSideBar
        },
    }
</script>

<style  scoped>

</style>
