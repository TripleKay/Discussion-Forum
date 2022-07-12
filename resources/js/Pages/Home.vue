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
    }
</script>

<style lang="stylus" scoped>

</style>
