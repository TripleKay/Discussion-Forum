<template>
    <div>
        <!-- ------------nav bar----------------  -->
        <Nav></Nav>
        <!-- ------------content---------------  -->
        <div class="container-fluid min-vh-100 bg-light" style="">
            <div class="container">
                <div class="row py-5">
                    <!-- ------------tags---------------  -->
                    <div class="col-12 col-md-4">
                        <SideBar></SideBar>
                    </div>
                    <!-- ------------questions---------------  -->
                    <div class="col-12 col-md-8">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Nav from "./Nav.vue";
import SideBar from "./SideBar.vue";
    export default {
        name: 'Master',
        components: {
            Nav,SideBar
        }
    }
</script>

<style lang="stylus" scoped>

</style>
