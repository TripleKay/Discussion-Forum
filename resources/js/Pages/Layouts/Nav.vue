<template>
    <div>
        <div class="container-fluid bg-white shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg  bg-white">
                            <div class="container-fluid">
                                <a class="navbar-brand text-uppercase" href="#">My Forum</a>

                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                                    <ul class="navbar-nav  mb-2 mb-lg-0 d-flex">
                                        <li class="nav-item">
                                            <Link class="nav-link active" aria-current="page" :href="route('home')">Home</Link>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <div class="modal-content bg-light" style="border-radius: 15px">

                                                <div class="modal-body">

                                                    <div class="d-flex bg-white overflow-hidden mb-3 searchBox" style="border-radius: 15px; border: 1px solid var(--bs-secondary)">
                                                        <div class="d-flex align-items-center ps-3  text-secondary bg-white"><i class="fas fa-search"></i></div>
                                                        <input @keyup="search()" v-model="searchKey" type="text" class="form-control form-control-lg border-0" placeholder="search question...">
                                                    </div>
                                                    <div v-show="searchKey.length == 0" class="text-center py-4" style="border-radius: 5px">
                                                        <p>No recent searches</p>
                                                    </div>
                                                    <div class="overflow-hidden" style="border-radius: 5px">
                                                         <div @click="questionDetail(que.slug)" v-for="(que,index) in questions" :key="index"  data-bs-dismiss="modal" class="questionBox btn d-flex justify-content-between align-items-center text-start w-100 py-3 px-3 bg-white mt-1">
                                                            <p class="mb-0">{{ que.title }}</p>
                                                            <i class="fas fa-angle-right"></i>
                                                        </div>
                                                    </div>
                                                     <div v-if="questions.length == 0 && searchKey.length != 0" class="text-center py-4" style="border-radius: 5px">
                                                        <p class="text-danger">No results for "{{searchKey}}"</p>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle btn py-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img :src="'/uploads/users/'+$page.props.auth_user.image" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                                            <span class="ms-2 fw-bold">{{ $page.props.auth_user.name }}</span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><Link class="dropdown-item" href="/profile/edit"><i class="fas fa-user-edit me-2"></i>Profile</Link></li>
                                            <li><Link :href="route('profile.userQuestion')" class="dropdown-item"><i class="fas fa-question-circle me-2"></i>Your Questions</Link></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><Link class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</Link></li>
                                        </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
    export default {
        name: "Nav",
        components: {
            Link
        },
        data () {
            return {
                searchKey: '',
                questions: '',
            }
        },
        methods: {
            search () {
                if(this.searchKey.length != 0){
                    let data = { searchKey: this.searchKey};
                    axios.post(this.route('question.search'),data).then((response) => {
                            this.questions = response.data.questions;
                        })
                }else{
                    this.questions = '';
                }
            },
            questionDetail(slug){
                this.$inertia.get(this.route('question.detail',slug));
            }
        }
    }
</script>

<style scoped>
    .searchBox input:focus{
        box-shadow: none;
    }
    .questionBox:hover{
        background: var(--bs-secondary) !important;
        color: #fff !important;
    }
</style>
