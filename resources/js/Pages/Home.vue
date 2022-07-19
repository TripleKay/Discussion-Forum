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
            <div v-for="(que,index) in questions" :key="que.id" class="card border-0 mb-3" style="border-radius: 15px;">
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
                            <i class="far fa-heart text-center py-2 rounded-circle bg-light text-secondary" style="width: 30px; height: 30px"></i>
                            <div class="btn-group">
                                <i v-if="isOwned(que.user_id) == true" class="fas fa-ellipsis-v text-center py-2 rounded-circle bg-light text-secondary ms-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="width: 30px; height: 30px"></i>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Delete Question</a></li>
                                    <li><a class="dropdown-item" href="#">Question Is Solved</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="h6 mb-0 me-2">
                                <span v-if="que.is_solved == 'true'" class="btn btn-light text-success btn-sm py-0">Is Solved !</span>
                                <span v-else class="btn btn-light text-danger btn-sm py-0">Need Solved ?</span>
                            </div>
                            <h4 class="mb-0">{{ que.title }}</h4>
                        </div>
                        <p class="text-black-50">{{ que.description }}</p>
                        <div class="">
                            <div v-for="tag in que.tag" :key="tag.id" class="badge bg-light text-secondary rounded-pill fw-normal me-1 mb-1">{{ tag.name }}</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="me-3  d-flex align-items-center">
                                <i v-show="!que.isLike" @click="like(que.id,index)" class="far fa-thumbs-up text-center py-2 rounded-circle bg-light text-primary like" style="width: 30px; height: 30px"></i>
                                <i v-show="que.isLike" @click="like(que.id,index)" class="fas fa-thumbs-up text-center py-2 rounded-circle bg-light text-primary like" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">{{ que.likeCount }}</span>
                            </div>
                            <div class="me-3  d-flex align-items-center">
                                <i class="far fa-comment text-center py-2 rounded-circle bg-light  text-success" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">{{ que.comment.length }}</span>
                            </div>
                            <div class="me-3  d-flex align-items-center">
                                <i class="far text-center py-2 rounded-circle bg-light fa-star text-warning" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">3</span>
                            </div>
                        </div>
                        <Link :href="route('question.detail',que.slug)" class="btn btn-outline-secondary">Read More</Link>
                    </div>
                </div>
            </div>
        </Master>
    </div>
</template>

<script>
import Master from "./Layouts/Master.vue";
import { Link } from '@inertiajs/inertia-vue3'
    export default {
        name: 'Home',
        data () {
            return {
                questions: '',
            }
        },
        components: {
            Master,Link
        },
        methods: {
            like (id,index) {
                if(this.questions[index].isLike != true){
                    this.questions[index].isLike = true;
                    this.questions[index].likeCount++;
                     axios.get(`question/like/${id}`).then((response) => {
                        if(response.success){
                            alert(response.success);
                        }
                    })
                }else{
                    this.questions[index].isLike = false;
                    this.questions[index].likeCount--;
                     axios.get(`question/disLike/${id}`).then((response) => {
                        if(response.success){
                            alert(response.success);
                        }
                    })
                }
            },
            isOwned(userId){
                var authUserId = this.$page.props.auth_user.id;
                if(userId == authUserId){
                    return true;
                }else{
                    return false;
                }
            }
        },
        created(){
            this.questions = this.$page.props.questions;
        }
    }
</script>

<style  scoped>
    .like:hover {
        transform: scale(1.2) rotate(-30deg);
        transition: .3s linear;
    }
    .dropdown-toggle::after{
        display: none;
    }
</style>
