<template>
    <div>
        <div class="container-fluid bg-light min-vh-100 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                         <div class="border-0 shadow card"  style="border-radius: 15px">
                            <div class="bg-transparent card-header">
                                <h4 class="my-2">Login</h4>
                            </div>
                            <div class="card-body">
                                <div v-if="$page.props.flash.message" class="alert alert-danger alert-dismissible fade show" role="alert">
                                     {{ $page.props.flash.message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <form @submit.prevent="login">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" :class="[ 'form-control', errors.email ? 'border border-danger' : '' ]" id="email" v-model="email" placeholder="enter your email" style="border-radius: 15px;">
                                        <small class="text-danger" v-if="errors.email">{{ errors.email }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" :class="[ 'form-control', errors.password ? 'border border-danger' : '' ]" id="password" v-model="password" placeholder="enter your password" style="border-radius: 15px;">
                                        <small class="text-danger" v-if="errors.password">{{ errors.password }}</small>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center">
                                        <button class="btn btn-primary" :disabled="loading">
                                        <div v-show="loading" class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <span v-show="loading">wait...</span>
                                        <span v-show="!loading">Login</span>
                                        </button>
                                        <p class="mb-0 ms-3">If you don't have an account,<Link :href="route('register')" class="text-danger">REGISTER HERE</Link> </p>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
    export default {
        name: 'Login',
        data () {
            return {
                email: '',
                password: '',
                loading: false,
            }
        },
        components: {
            Link
        },
        props: {
            errors : Object,
        },
        methods: {
            login () {
                this.loading = true;
                var data = new FormData();
                data.append('email',this.email);
                data.append('password',this.password);
                this.$inertia.post('/login',data,{
                    onFinish: () => this.loading = false
                });
            }
        }
    }
</script>

<style scoped>

</style>
