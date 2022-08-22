<template>
    <div>
        <div class="bg-white shadow-sm container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="bg-white navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <a class="navbar-brand text-uppercase" href="#">My Forum</a>

                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                                    <ul class="mb-2 navbar-nav mb-lg-0 d-flex">
                                        <li class="nav-item">
                                            <Link class="nav-link" :class="{ 'active': route().current('home') }"  :href="route('home')">Home</Link>
                                        </li>
                                        <li v-if="$page.props.auth_user.role == 'admin'" class="nav-item">
                                            <Link class="nav-link" :class="{ 'active': route().current('dashboard') }"  :href="route('dashboard')">Dashboard</Link>
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

                                                    <div class="mb-3 overflow-hidden bg-white d-flex searchBox" style="border-radius: 15px; border: 1px solid var(--bs-secondary)">
                                                        <div class="bg-white d-flex align-items-center ps-3 text-secondary"><i class="fas fa-search"></i></div>
                                                        <input @keyup="search()" v-model="searchKey" type="text" class="border-0 form-control form-control-lg" placeholder="search question...">
                                                    </div>
                                                    <div v-show="searchKey.length == 0" class="py-4 text-center" style="border-radius: 5px">
                                                        <p>No recent searches</p>
                                                    </div>
                                                    <div class="overflow-hidden" style="border-radius: 5px">
                                                         <div @click="questionDetail(que.slug)" v-for="(que,index) in questions" :key="index"  data-bs-dismiss="modal" class="px-3 py-3 mt-1 bg-white questionBox btn d-flex justify-content-between align-items-center text-start w-100">
                                                            <p class="mb-0">{{ que.title }}</p>
                                                            <i class="fas fa-angle-right"></i>
                                                        </div>
                                                    </div>
                                                     <div v-if="questions.length == 0 && searchKey.length != 0" class="py-4 text-center" style="border-radius: 5px">
                                                        <p class="text-danger">No results for "{{searchKey}}"</p>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown">
                                        <a class="py-0 nav-link dropdown-toggle btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    .nav-link {
        color: var(--bs-secondary) ;
        border: 1px solid transparent;
        border-radius: 30px;
        margin: 0 2px;
        transition: .3s linear;
    }
    .nav-link.active,
    .nav-link:hover{
        color: var(--bs-dark);
        border: 1px solid var(--bs-secondary);
        border-radius: 10px;
        transition: .3s linear;
    }
</style>
