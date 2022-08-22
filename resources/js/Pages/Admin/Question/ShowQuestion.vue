<template>
    <div>
        <AdminMaster>
            <!-- ------------content---------------  -->
            <QuestionDetail :question="question"></QuestionDetail>
        </AdminMaster>
    </div>
</template>

<script>
import AdminMaster from "../Layouts/AdminMaster.vue";
import { Link } from '@inertiajs/inertia-vue3';
import QuestionDetail from "../../Components/QuestionDetail.vue";

    export default {
        name: 'QuestionList',
        components: {
            AdminMaster,Link,QuestionDetail
        },
        data () {
            return {
                question: '',
            }
        },
        created(){
            this.question = this.$page.props.question;
        }
    }
</script>

<style  scoped>

</style>
