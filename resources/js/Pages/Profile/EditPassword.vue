<template>
    <div>
        <Master>
            <div class="card border-0 mb-4"  style="border-radius: 15px;">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0 py-2">Change Password</h5>
                </div>
                <div class="card-body">
                    <div v-if="$page.props.flash.message" class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $page.props.flash.message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="updatePassword">
                        <div class="mb-3">
                            <label for="" class="form-label">Old Password</label>
                            <input type="password" class="form-control" v-model="oldPassword" style="border-radius: 15px;">
                            <small class="text-danger" v-if="errors.oldPassword">{{ errors.password }}</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" class="form-control" v-model="newPassword" style="border-radius: 15px;">
                            <small class="text-danger" v-if="errors.newPassword">{{ errors.newPassword }}</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" v-model="confirmPassword" style="border-radius: 15px;">
                            <small class="text-danger" v-if="errors.confirmPassword">{{ errors.confirmPassword }}</small>
                        </div>
                        <div class="mt-4 d-flex align-items-center float-end">
                            <button class="btn btn-primary " :disabled="loading">
                                <div v-show="loading" class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span v-show="loading">wait...</span>
                                <span v-show="!loading">Update Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Master>
    </div>
</template>

<script>
import Master from "../Layouts/Master.vue"
    export default {
        name: 'EditPassword',
        components: {
            Master
        },
        data () {
            return {
                oldPassword: '',
                newPassword: '',
                confirmPassword: '',
                loading: false,
            }
        },
        props: {
            errors : Object,
        },
        methods: {
            updatePassword(){
                this.loading = true;
                var data = new FormData;
                data.append('oldPassword',this.oldPassword);
                data.append('newPassword',this.newPassword);
                data.append('confirmPassword',this.confirmPassword);
                this.$inertia.post(this.route('profile.updatePassword'),data,{
                    onFinish: () => this.loading = false
                });

            }
        },
    }
</script>

<style lang="stylus" scoped>

</style>
