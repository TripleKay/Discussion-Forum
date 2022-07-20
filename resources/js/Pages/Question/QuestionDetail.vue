<template>
    <div>
        <Master>
            <div class="card border-0" style="border-radius: 15px">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <img :src="imgPath+question.user.image" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                            <div class="ms-2">
                                <h6 class="mb-0">{{ question.user.name }}</h6>
                                <span class="text-black-50">{{ question.time }}</span>
                            </div>
                        </div>
                        <div class="me-3  d-flex align-items-center">
                            <i class="far fa-heart text-center py-2 rounded-circle bg-light text-secondary" style="width: 30px; height: 30px"></i>
                            <div class="btn-group">
                                <i  class="fas fa-ellipsis-v text-center py-2 rounded-circle bg-light text-secondary ms-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="width: 30px; height: 30px"></i>
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
                                <span v-if="question.is_solved == 'true'" class="btn btn-light text-success btn-sm py-0">Is Solved !</span>
                                <span v-else class="btn btn-light text-danger btn-sm py-0">Need Solved ?</span>
                            </div>
                            <h4 class="mb-0">{{ question.title }}</h4>
                        </div>
                        <p class="text-black-50">{{ question.description }}</p>
                        <div class="">
                            <div v-for="tag in question.tag" :key="tag.id" class="badge bg-light text-secondary rounded-pill fw-normal me-1 mb-1">{{tag.name}}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="me-3  d-flex align-items-center">
                            <i  class="far fa-thumbs-up text-center py-2 rounded-circle bg-light text-primary like" style="width: 30px; height: 30px"></i>
                            <span class="mb-0 ms-1 text-dark">{{ question.likeCount }}</span>
                        </div>
                        <div class="me-3  d-flex align-items-center">
                            <i class="far fa-comment text-center py-2 rounded-circle bg-light  text-success" style="width: 30px; height: 30px"></i>
                            <span class="mb-0 ms-1 text-dark">{{ question.comment.length }}</span>
                        </div>
                        <div class="me-3  d-flex align-items-center">
                            <i class="far text-center py-2 rounded-circle bg-light fa-star text-warning" style="width: 30px; height: 30px"></i>
                            <span class="mb-0 ms-1 text-dark">3</span>
                        </div>
                    </div>
                    <hr>
                    <!-- comment  -->
                    <div class="">
                        <div class="d-flex mb-3">
                            <img :src="imgPath+$page.props.auth_user.image" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                            <form @submit.prevent="createComment" class="d-flex w-100">
                                <input v-model="comment" type="text" class="form-control rounded-pill ms-2" placeholder="enter your question ......">
                                <button  class="ms-2 btn btn-secondary rounded-circle"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                        <!-- comment box  -->
                        <div v-for="comment in question.comment" :key="comment.id" class="d-flex mb-3">
                            <div class="d-flex">
                                <img :src="imgPath+comment.user.image" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                            </div>
                            <div class="ms-2 bg-light p-3 w-100" style="border-radius: 15px">
                                <div class="mb-2 d-flex align-items-center">
                                    <h6 class="mb-0">{{ comment.user.name }}</h6>
                                    <span class="text-black-50 ms-2">{{ comment.time }}</span>
                                </div>
                                <p>{{ comment.comment }}</p>
                            </div>
                        </div>
                        <!-- end comment box  -->

                    </div>
                </div>
            </div>
        </Master>
    </div>
</template>

<script>
import Master from "../Layouts/Master.vue";
import { Link } from '@inertiajs/inertia-vue3'
    export default {
        name: "QuestionDetail",
        components: {
            Master,Link
        },
        data () {
            return {
                question: '',
                comment: '',
                imgPath: '/uploads/users/',
            }
        },
        methods: {
            createComment () {
                const data = new FormData;
                data.append('comment',this.comment);
                data.append('questionId',this.question.id);
                axios.post('/question/comment',data).then((response) => {
                        if(response.data.success){
                            this.question.comment.push(response.data.comment);
                            this.comment = '';
                        }
                        console.log('success');
                    })
            }
        },
        created(){
            this.question = this.$page.props.question;
        }
    }
</script>

<style  scoped>
    .dropdown-toggle::after{
        display: none;
    }
</style>
