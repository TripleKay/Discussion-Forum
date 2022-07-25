<template>
    <div>
        <Master>
            <div class="card border-0 mb-4"  style="border-radius: 15px;">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0 py-2">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateProfile">
                        <img :src="imageSrc" class="rounded-circle" alt="" srcset="" style="width: 100px; height: 100px">
                        <div class="my-3">
                            <label for="" class="form-label">Change Profile Photo</label>
                            <input type="file" class="form-control" @change="selectImage"  style="border-radius: 15px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" v-model="name"  style="border-radius: 15px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" v-model="email"  style="border-radius: 15px;">
                        </div>
                        <button class="btn btn-primary float-end mt-3">Update Profile</button>
                    </form>
                </div>
            </div>
            <div class="card border-0 mb-4"  style="border-radius: 15px;">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0 py-2">Change Password</h5>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="" class="form-label">Old Password</label>
                            <input type="password" class="form-control"  style="border-radius: 15px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" class="form-control"  style="border-radius: 15px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" style="border-radius: 15px;">
                        </div>
                        <button class="btn btn-primary float-end mt-3">Update Password</button>
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
                imageSrc: '/uploads/users/'+this.$page.props.auth_user.image,
                newImage: '',
            }
        },
        methods: {
            selectImage (e) {
                this.newImage = e.target.files[0];
            },
            updateProfile(){
                var data = new FormData;
                data.append('name',this.name);
                data.append('email',this.email);
                data.append('newImage',this.newImage);
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
