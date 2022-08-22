<template>
    <div>
        <Master>

            <!-- ------------new questions create box---------------  -->
            <div class="mb-3 border-0 card" style="border-radius: 15px">
                <div class="card-body">
                    <div class="d-flex">
                        <img :src="imgPath+this.$page.props.auth_user.image" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                        <Link :href="route('question.create')" class="p-0 m-0 btn w-100 ms-3"><input type="text" class="form-control rounded-pill" placeholder="enter your question ......"></Link>
                    </div>
                </div>
            </div>

            <!-- ------------questions content box---------------  -->
            <Question :questions="questions.data"></Question>

            <Pagination v-if="questions.per_page < questions.links.length" :links="questions.links" />
        </Master>
    </div>
</template>

<script>
import Master from "./Layouts/Master.vue";
import Question from "./Components/Question.vue";
import Pagination from "./Components/Pagination.vue";
import { Link } from '@inertiajs/inertia-vue3';
    export default {
        name: 'Home',
        data () {
            return {
                questions: '',
                imgPath: '/uploads/users/',
            }
        },
        components: {
            Master,Link,Question,Pagination
        },
        methods: {

        },
        created(){
            this.questions = this.$page.props.questions;
        }
    }
</script>

<style  scoped>

</style>
