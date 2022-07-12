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
                                            <span class="ms-2 fw-bold">Triple Kay</span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#">Profile</a></li>
                                            <li><a class="dropdown-item" href="#">Question</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#">Logout</a></li>
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
        <div class="container-fluid min-vh-100 bg-light" style="">
            <div class="container">
                <div class="row py-5">
                    <div class="col-4">
                        <div class="card border-0" style="border-radius: 15px;">
                            <div class="card-header bg-transparent">
                                <h5 class="mb-0 py-2">All Tags</h5>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <button class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Web Development</button>
                                    <button class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Web Development</button>
                                    <button class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Web Development</button>
                                    <button class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Web Development</button>
                                    <button class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Web Development</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card mb-3 border-0" style="border-radius: 15px">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="https://cdn2.iconfinder.com/data/icons/flatfaces-everyday-people-square/128/beard_male_man_face_avatar-512.png" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                                    <input type="text" class="form-control rounded-pill ms-3" placeholder="enter your question ......">
                                </div>
                            </div>
                        </div>
                        <div class="card border-0" style="border-radius: 15px;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <img src="https://cdn2.iconfinder.com/data/icons/flatfaces-everyday-people-square/128/beard_male_man_face_avatar-512.png" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="mb-0">Triple Kay</h6>
                                            <span class="text-black-50">6 min ago</span>
                                        </div>
                                    </div>
                                    <div class="me-3  d-flex align-items-center">
                                        <i class="fas text-center py-2 rounded-circle bg-light fa-heart text-danger" style="width: 30px; height: 30px"></i>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <h4>What Is Javascript behind the scene?</h4>
                                    <p class="text-black-50">Lorem ipsum dolor sit amet consectetur adipisicing elit. A veniam nobis voluptas quo. Facilis officiis blanditiis magni vitae sunt dolores a nulla, accusamus nemo doloribus dolorem, tempore mollitia iure modi.</p>
                                    <div class="">
                                        <div class="badge bg-light text-secondary rounded-pill fw-normal me-1 mb-1">Web Devepoment</div>
                                        <div class="badge bg-light text-secondary rounded-pill fw-normal me-1 mb-1">Javascript</div>
                                        <div class="badge bg-light text-secondary rounded-pill fw-normal me-1 mb-1">Web Devepoment</div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-3  d-flex align-items-center">
                                            <i class="fas text-center py-2 rounded-circle bg-light fa-heart text-danger" style="width: 30px; height: 30px"></i>
                                            <span class="mb-0 ms-1 text-dark">3</span>
                                        </div>
                                        <div class="me-3  d-flex align-items-center">
                                            <i class="fas text-center py-2 rounded-circle bg-light fa-comment text-success" style="width: 30px; height: 30px"></i>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style lang="stylus" scoped>

</style>
