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
                                            <Link class="nav-link " :href="route('showSaveQuestion')">Saved Questions</Link>
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
        }
    }
</script>

<style lang="stylus" scoped>

</style>
