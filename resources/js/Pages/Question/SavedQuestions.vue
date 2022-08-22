<template>
    <div>
        <Master>
            <div v-for="(que,index) in questions.data" :key="index" class="mb-3 border-0 card" style="border-radius: 15px">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="mb-0 h6 me-2">
                            <span v-if="que.question.is_solved == 'true'" class="py-0 btn btn-light text-success btn-sm">Is Solved !</span>
                            <span v-else class="py-0 btn btn-light text-danger btn-sm">Need Solved ?</span>
                        </div>
                        <i @click="unSaveQuestion(que.question.id,index)" class="py-2 text-center fas fa-heart rounded-circle bg-light text-danger" style="width: 30px; height: 30px"></i>
                    </div>
                    <h4 class="">{{ que.question.title }}</h4>
                    <p class=" text-secondary">{{ que.question.description.substring(0,150) }}.....</p>
                    <Link :href="route('question.detail',que.question.slug)" class="btn btn-outline-secondary btn-sm" style="border-radius: 10px">Read More</Link>

                </div>
            </div>

            <Pagination v-if="questions.per_page < questions.links.length" :links="questions.links" />
        </Master>
    </div>
</template>

<script>
import Master from "../Layouts/Master.vue";
import Pagination from "../Components/Pagination.vue";
import { Link } from '@inertiajs/inertia-vue3'
    export default {
        name: 'Home',
        data () {
            return {
                questions: '',
                imgPath: '/uploads/users/',
            }
        },
        components: {
            Master,Link,Pagination
        },
        methods: {
             unSaveQuestion(id,index){
                var data = new FormData;
                data.append('id',id);
                axios.post(this.route('question.unSave'),data).then((response) => {
                    if(response.data.success){
                       this.questions.data.splice(index,1);
                    }
                })
            }
        },
        created(){
            this.questions = this.$page.props.questions;
        }
    }
</script>

<style  scoped>

</style>
