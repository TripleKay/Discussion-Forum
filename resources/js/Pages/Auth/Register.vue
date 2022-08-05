<template>
    <div>
        <div class="container-fluid  bg-light min-vh-100 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card border-0 shadow" style="border-radius: 15px">
                            <div class="card-header bg-white border-0" style="border-radius: 15px">
                                <h4 class="my-2">Register</h4>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="register">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" :class="[ 'form-control', errors.name ? 'border border-danger' : '' ]" id="name" v-model="name" style="border-radius: 15px">
                                        <small class="text-danger" v-if="errors.name">{{ errors.name }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" :class="[ 'form-control', errors.email ? 'border border-danger' : '' ]" id="email" v-model="email" style="border-radius: 15px">
                                        <small class="text-danger" v-if="errors.email">{{ errors.email }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Profile Photo</label>
                                        <input :class="[ 'form-control', errors.image ? 'border border-danger' : '' ]" type="file" id="image" @change="selectImage" style="border-radius: 15px">
                                        <small class="text-danger" v-if="errors.image">{{ errors.image }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Password</label>


                                        <input type="password" :class="[ 'form-control', errors.password ? 'border border-danger' : '' ]" id="password" v-model="password" style="border-radius: 15px">
                                        <small class="text-danger" v-if="errors.password">{{ errors.password }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Confirm Password</label>
                                        <input type="confirmPassword" :class="['form-control', errors.password_confirmation ? 'border border-danger' : '' ]" id="password_confirmation" v-model="confirmPassword" style="border-radius: 15px">
                                        <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation }}</small>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center">
                                        <button class="btn btn-primary " :disabled="loading">
                                        <div v-show="loading" class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <span v-show="loading">wait...</span>
                                        <span v-show="!loading">Register</span>
                                    </button>
                                    <p class="mb-0 ms-3">If you have an account,<Link :href="route('login')" class="text-danger">LOGIN HERE</Link> </p>
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
        name: "Register",
        data () {
            return {
                name: '' ,
                email: '' ,
                image: '' ,
                password: '' ,
                confirmPassword: '',
                loading: false,
            }
        },
        components: {
            Link
        },
        //## props
        props: {
            errors: Object
        },
        //## methods
        methods: {
            selectImage (e) {
                this.image = e.target.files[0];
            },
            register(){
                this.loading = true;
                var data = new FormData();
                data.append('name',this.name);
                data.append('email',this.email);
                data.append('image',this.image);
                data.append('password',this.password);
                data.append('password_confirmation',this.confirmPassword);
                this.$inertia.post('/register', data ,{
                    onFinish: () => this.loading = false
                });
            },
        }
    }
</script>

<style lang="stylus" scoped>

</style>
