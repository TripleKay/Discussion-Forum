<template>
    <div>
        <div class="container-fluid bg-light min-vh-100 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-6 offset-3">
                         <div class="card border-0 rounded shadow">
                            <div class="card-header bg-primary text-white">
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
                                        <input type="email" :class="[ 'form-control', errors.email ? 'border border-danger' : '' ]" id="email" v-model="email">
                                        <small class="text-danger" v-if="errors.email">{{ errors.email }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" :class="[ 'form-control', errors.password ? 'border border-danger' : '' ]" id="password" v-model="password">
                                        <small class="text-danger" v-if="errors.password">{{ errors.password }}</small>
                                    </div>
                                    <button class="btn btn-primary float-end" :disabled="loading">
                                        <div v-show="loading" class="spinner-border spinner-border-sm text-light" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <span v-show="loading">wait...</span>
                                        <span v-show="!loading">Login</span>
                                    </button>
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
    export default {
        name: 'Login',
        data () {
            return {
                email: '',
                password: '',
                loading: false,
            }
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

<style lang="stylus" scoped>

</style>
