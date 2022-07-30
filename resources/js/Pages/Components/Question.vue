<template>
    <div>
         <!-- ------------questions content box---------------  -->
            <div v-for="(que,index) in questions" :key="que.id"  class="card border-0 mb-3" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <!-- ------------user---------------  -->
                        <div class="d-flex">
                            <img :src="imgPath+que.user.image" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                            <div class="ms-2">
                                <h6 class="mb-0">{{ que.user.name }}</h6>
                                <span class="text-black-50">{{ que.time }}</span>
                            </div>
                        </div>
                        <!-- ------------menu---------------  -->
                        <div class="me-3  d-flex align-items-center">
                            <!-- ------------save---------------  -->
                            <i v-show="!que.isSaved" @click="saveQuestion(que.id,index)" class="far fa-heart text-center py-2 rounded-circle bg-light text-secondary" style="width: 30px; height: 30px"></i>
                            <i v-show="que.isSaved" @click="unSaveQuestion(que.id,index)" class="fas fa-heart text-center py-2 rounded-circle bg-light text-danger" style="width: 30px; height: 30px"></i>
                            <!-- ------------drop down---------------  -->
                            <div class="btn-group">
                                <i v-if="isOwned(que.user_id) == true" class="fas fa-ellipsis-v text-center py-2 rounded-circle bg-light text-secondary ms-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="width: 30px; height: 30px"></i>
                                <ul class="dropdown-menu">
                                    <li><button class="dropdown-item"><i class="fas fa-edit me-2"></i>Edit Question</button></li>
                                    <li><button @click="deleteQuestion(que.id,index)" class="dropdown-item"><i class="fas fa-trash me-2"></i>Delete Question</button></li>
                                    <li v-show="que.is_solved == 'false'"><button @click="makeSolved(que.id,index)" class="dropdown-item"><i class="far fa-check-circle me-2"></i>Question Is Solved</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <!-- ------------title and status---------------  -->
                        <div class="d-flex align-items-center mb-2">
                            <div class="h6 mb-0 me-2">
                                <span v-if="que.is_solved == 'true'" class="btn btn-light text-success btn-sm py-0">Is Solved !</span>
                                <span v-else class="btn btn-light text-danger btn-sm py-0">Need Solved ?</span>
                            </div>
                            <h4 class="mb-0">{{ que.title }}</h4>
                        </div>
                        <!-- ------------description---------------  -->
                        <p class="text-black-50">{{ que.description.substring(0,280) }}.....</p>
                        <!-- ------------tags---------------  -->
                        <div class="">
                            <div v-for="tag in que.tag" :key="tag.id" class="badge bg-light text-secondary rounded-pill fw-normal me-1 mb-1">{{ tag.name }}</div>
                        </div>
                    </div>
                    <!-- ------------reactions---------------  -->
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <!-- ------------likes---------------  -->
                            <div class="me-3  d-flex align-items-center">
                                <i v-show="!que.isLike" @click="like(que.id,index)" class="far fa-thumbs-up text-center py-2 rounded-circle bg-light text-primary like" style="width: 30px; height: 30px"></i>
                                <i v-show="que.isLike" @click="like(que.id,index)" class="fas fa-thumbs-up text-center py-2 rounded-circle bg-light text-primary like" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">{{ que.likeCount }}</span>
                            </div>
                            <!-- ------------comments---------------  -->
                            <div class="me-3  d-flex align-items-center">
                                <i class="far fa-comment text-center py-2 rounded-circle bg-light  text-success" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">{{ que.comment.length }}</span>
                            </div>
                            <!-- ------------views---------------  -->
                            <div class="me-3  d-flex align-items-center">
                                <i class="far fa-eye text-center py-2 rounded-circle bg-light text-secondary" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">3</span>
                            </div>
                        </div>
                        <Link :href="route('question.detail',que.slug)" class="btn btn-outline-secondary">Read More</Link>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

    export default {
        name: 'Question',
        components: {
            Link
        },
        props: {
            questions:Object
        },
        data () {
            return {
                imgPath: '/uploads/users/',
            }
        },
        methods: {
            like (id,index) {
                if(this.questions[index].isLike != true){
                    this.questions[index].isLike = true;
                    this.questions[index].likeCount++;
                     axios.get(`/question/like/${id}`).then((response) => {
                        if(response.success){
                            alert(response.success);
                        }
                    })
                }else{
                    this.questions[index].isLike = false;
                    this.questions[index].likeCount--;
                     axios.get(`/question/disLike/${id}`).then((response) => {
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
            },

            deleteQuestion(id,index){
                axios.get(this.route('question.delete',id)).then((response) => {
                        if(response.data.success){
                            this.questions.splice(index,1);
                        }
                    })
            },

            makeSolved(id,index){
                var data = new FormData;
                data.append('id',id);
                axios.post(this.route('question.makeSolved'),data).then((response) => {
                    if(response.data.success){
                        this.questions[index].is_solved = "true";
                    }
                })
            },

            saveQuestion(id,index){
                var data = new FormData;
                data.append('id',id);
                axios.post(this.route('question.save'),data).then((response) => {
                    if(response.data.success){
                        this.questions[index].isSaved = true;
                    }
                })
            },

            unSaveQuestion(id,index){
                var data = new FormData;
                data.append('id',id);
                axios.post(this.route('question.unSave'),data).then((response) => {
                    if(response.data.success){
                        this.questions[index].isSaved = false;
                    }
                })
            }

        },
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
