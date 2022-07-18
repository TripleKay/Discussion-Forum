<template>
    <div>
        <div class="container-fluid bg-white shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg  bg-white">
                            <div class="container-fluid">
                                <a class="navbar-brand text-uppercase" href="#">My Forum</a>
                                <div class="d-flex justify-content-center w-100">
                                    <form class="d-flex" role="search">
                                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </form>
                                </div>

                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                                    <ul class="navbar-nav  mb-2 mb-lg-0 d-flex">
                                        <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle btn py-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="https://cdn2.iconfinder.com/data/icons/flatfaces-everyday-people-square/128/beard_male_man_face_avatar-512.png" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                                            <span class="ms-2 fw-bold">{{ $page.props.auth_user.name }}</span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><Link class="dropdown-item" href="/profile">Profile</Link></li>
                                            <li><a class="dropdown-item" href="#">Question</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><Link class="dropdown-item" href="/logout">Logout</Link></li>
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
