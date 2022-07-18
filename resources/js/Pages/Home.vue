<template>
    <div>
        <Master>
            <!-- ------------new questions create box---------------  -->
            <div class="card mb-3 border-0" style="border-radius: 15px">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="https://cdn2.iconfinder.com/data/icons/flatfaces-everyday-people-square/128/beard_male_man_face_avatar-512.png" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                        <input type="text" class="form-control rounded-pill ms-3" placeholder="enter your question ......">
                    </div>
                </div>
            </div>

            <!-- ------------questions content box---------------  -->
            <div v-for="que in $page.props.questions" :key="que.id" class="card border-0 mb-3" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <img src="https://cdn2.iconfinder.com/data/icons/flatfaces-everyday-people-square/128/beard_male_man_face_avatar-512.png" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                            <div class="ms-2">
                                <h6 class="mb-0">{{ que.user.name }}</h6>
                                <span class="text-black-50">6 min ago</span>
                            </div>
                        </div>
                        <div class="me-3  d-flex align-items-center">
                            <i class="fas text-center py-2 rounded-circle bg-light fa-heart text-danger" style="width: 30px; height: 30px"></i>
                        </div>
                    </div>
                    <div class="my-4">
                        <h4>{{ que.title }}</h4>
                        <p class="text-black-50">{{ que.description }}</p>
                        <div class="">
                            <div v-for="tag in que.tag" :key="tag.id" class="badge bg-light text-secondary rounded-pill fw-normal me-1 mb-1">{{ tag.name }}</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="me-3  d-flex align-items-center">
                                <!-- <i class="fas text-center py-2 rounded-circle bg-light fa-heart text-danger" style="width: 30px; height: 30px"></i> -->
                                <i @click="like(que.id)" class="fa fa-thumbs-up fw-normal text-center py-2 rounded-circle bg-light text-danger" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">3</span>
                            </div>
                            <div class="me-3  d-flex align-items-center">
                                <i class="fas fa-comment text-center py-2 rounded-circle bg-light  text-success" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">3</span>
                            </div>
                            <div class="me-3  d-flex align-items-center">
                                <i class="fas text-center py-2 rounded-circle bg-light fa-star text-warning" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">3</span>
                            </div>
                        </div>
                        <div class="btn btn-outline-secondary">Read More</div>
                    </div>
                </div>
            </div>
        </Master>
    </div>
</template>

<script>
import Master from "./Layouts/Master.vue";
    export default {
        name: 'Home',
        components: {
            Master
        },
        methods: {
            like (id) {
                alert(id);
            }
        }
    }
</script>

<style lang="stylus" scoped>

</style>
