<template>
    <div>
        <!-- ------------nav bar----------------  -->
        <Nav></Nav>
            <Toast v-if="this.$page.props.flash.message != null" :icon="'success'" :title="this.$page.props.flash.message"></Toast>

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
import Toast from '../Components/SuccessAlert.vue'

    export default {
        name: 'Master',
        components: {
            Nav,SideBar,Toast
        }
    }
</script>

<style lang="stylus" scoped>

</style>
