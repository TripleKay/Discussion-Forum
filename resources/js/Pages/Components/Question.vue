<template>
    <div>
         <!-- ------------questions content box---------------  -->
            <div v-for="(que,index) in questions" :key="que.id"  class="mb-3 card questionCard" style="border-radius: 15px;">
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
                        <div class="me-3 d-flex align-items-center">
                            <!-- ------------save---------------  -->
                            <i v-show="!que.isSaved" @click="saveQuestion(que.id,index)" class="py-2 text-center iconBtn far fa-heart rounded-circle bg-light text-secondary" style="width: 30px; height: 30px"></i>
                            <i v-show="que.isSaved" @click="unSaveQuestion(que.id,index)" class="py-2 text-center iconBtn fas fa-heart rounded-circle bg-light text-danger" style="width: 30px; height: 30px"></i>
                            <!-- ------------drop down---------------  -->
                            <div class="btn-group">
                                <i v-if="isOwned(que.user_id) == true" class="py-2 text-center iconBtn fas fa-ellipsis-v rounded-circle bg-light text-secondary ms-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="width: 30px; height: 30px"></i>
                                <ul class="dropdown-menu">
                                    <li><Link :href="route('question.edit',que.slug)" class="dropdown-item"><i class="fas fa-edit me-2"></i>Edit Question</Link></li>
                                    <li><button @click="deleteQuestion(que.id,index)" class="dropdown-item"><i class="fas fa-trash me-2"></i>Delete Question</button></li>
                                    <li v-show="que.is_solved == 'false'"><button @click="makeSolved(que.id,index)" class="dropdown-item"><i class="far fa-check-circle me-2"></i>Question Is Solved</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <!-- ------------title and status---------------  -->
                        <div class="mb-2 d-flex align-items-center">
                            <div class="mb-0 h6 me-2">
                                <span v-if="que.is_solved == 'true'" class="text-nowrap py-0 btn btn-light text-success btn-sm">Is Solved !</span>
                                <span v-else class="py-0 btn btn-light text-danger btn-sm text-nowrap">Need Solved ?</span>
                            </div>
                            <h4 class="mb-0 underline-hover-effect">{{ que.title }}</h4>
                        </div>
                        <!-- ------------description---------------  -->
                        <p class="text-black-50">{{ que.description.substring(0,280) }}.....</p>
                        <!-- ------------tags---------------  -->
                        <div class="">
                            <div v-for="tag in que.tag" :key="tag.id" class="mb-1 badge bg-light text-secondary rounded-pill fw-normal me-1">{{ tag.name }}</div>
                        </div>
                    </div>
                    <!-- ------------reactions---------------  -->
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <!-- ------------likes---------------  -->
                            <div class="me-3 d-flex align-items-center">
                                <i v-show="!que.isLike" @click="like(que.id,index)" class="py-2 text-center far fa-thumbs-up rounded-circle bg-light text-primary like" style="width: 30px; height: 30px"></i>
                                <i v-show="que.isLike" @click="like(que.id,index)" class="py-2 text-center text-primary fas fa-thumbs-up rounded-circle bg-light like" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">{{ que.likeCount }}</span>
                            </div>
                            <!-- ------------comments---------------  -->
                            <div class="me-3 d-flex align-items-center">
                                <i class="py-2 text-center far fa-comment rounded-circle bg-light text-success" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">{{ que.comment.length }}</span>
                            </div>
                            <!-- ------------views---------------  -->
                            <div class="me-3 d-flex align-items-center">
                                <i class="py-2 text-center far fa-eye rounded-circle bg-light text-secondary" style="width: 30px; height: 30px"></i>
                                <span class="mb-0 ms-1 text-dark">{{ que.viewCount }}</span>
                            </div>
                        </div>
                        <Link :href="route('question.detail',que.slug)" class="btn btn-outline-secondary">Read More</Link>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2';

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
                        if(response.data.success){
                            console.log('like');
                        }
                    })
                }else{
                    this.questions[index].isLike = false;
                    this.questions[index].likeCount--;
                     axios.get(`/question/disLike/${id}`).then((response) => {
                        if(response.data.success){
                            console.log('dislike');
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
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to delete this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get(this.route('question.delete',id)).then((response) => {
                        if(response.data.success){
                            this.questions.splice(index,1);
                            }
                        });
                        Swal.fire(
                            'Deleted!',
                            'Your Question has been deleted.',
                            'success'
                        );
                    }
                })

            },

            makeSolved(id,index){
                var data = new FormData;
                data.append('id',id);
                axios.post(this.route('question.makeSolved'),data).then((response) => {
                    if(response.data.success){
                        this.questions[index].is_solved = "true";
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your question is solved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            },

            saveQuestion(id,index){
                var data = new FormData;
                data.append('id',id);
                axios.post(this.route('question.save'),data).then((response) => {
                    if(response.data.success){
                        this.questions[index].isSaved = true;
                         Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Question is saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
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
    .questionCard{
        border: 1px solid transparent !important;
        transform: scale(1);
        transition: .3s linear;
    }
    .questionCard:hover{
        border: 1px solid var(--bs-secondary) !important;
        /* transform: scale(1.02); */
        transition: .3s linear;
    }
    .questionCard .underline-hover-effect {
        text-decoration: none;
        color: inherit;
    }

    .underline-hover-effect {
        display: inline-block;
        padding-bottom: 0.25rem;
        position: relative;
    }

    .underline-hover-effect::before {
        content: "";
        position: absolute;
        right: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: var(--bs-primary);
        transition: width 0.25s ease-out;
    }
    .underline-hover-effect:hover::before {
        width: 100%;
        left: 0;
        right: auto;
    }
    .like {
        cursor: pointer !important;
        transition: .3s linear;
    }
    .like:hover,
    .like:focus {
        background: var(--bs-primary) !important;
        color: var(--bs-white) !important;
        transform: scale(1.2) rotate(-30deg);
        transition: .3s linear;
    }
    .dropdown-toggle::after{
        display: none;
    }
    .iconBtn {
        cursor: pointer !important;
        transition: .3s linear;
    }
    .iconBtn:hover,
    .iconBtn:active,
    .iconBtn:focus{
        background: var(--bs-dark) !important;
        color: var(--bs-white) !important;
        transition: .3s linear;
    }
</style>
