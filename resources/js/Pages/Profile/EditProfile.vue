<template>
    <div>
        <Master>
            <div class="card border-0 mb-4"  style="border-radius: 15px;">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0 py-2">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateProfile">
                        <img :src="'/uploads/users/'+$page.props.auth_user.image" class="rounded-circle" alt="" srcset="" style="width: 100px; height: 100px">
                        <div class="my-3">
                            <label for="" class="form-label">Change Profile Photo</label>
                            <input type="file" class="form-control" id="newImage" @change="selectImage"  style="border-radius: 15px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" v-model="name"  style="border-radius: 15px;">
                             <small class="text-danger" v-if="errors.name">{{ errors.name }}</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" v-model="email"  style="border-radius: 15px;">
                             <small class="text-danger" v-if="errors.email">{{ errors.email }}</small>
                        </div>
                        <div class="mt-4 d-flex align-items-center float-end">
                            <button class="btn btn-primary " :disabled="loading">
                                <div v-show="loading" class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span v-show="loading">wait...</span>
                                <span v-show="!loading">Update Profile</span>
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
        name: 'EditProfile',
        components: {
            Master
        },
        data () {
            return {
                name: '',
                email: '',
                newImage: '',
                loading: false,
            }
        },
        props: {
            errors: Object
        },
        methods: {
            selectImage (e) {
                this.newImage = e.target.files[0];
            },
            updateProfile(){
                this.loading = true;
                var data = new FormData;
                data.append('name',this.name);
                data.append('email',this.email);
                data.append('newImage',this.newImage);
                this.$inertia.post(this.route('profile.update'), data ,{
                    onFinish: () => this.loading = false
                });
            }
        },
        created(){
            const { name , email } = this.$page.props.auth_user;
            this.name = name;
            this.email = email;
        }
    }
</script>

<style lang="stylus" scoped>

</style>
