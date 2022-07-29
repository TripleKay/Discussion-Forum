<template>
    <div>
        <Master>
            <Question :questions="questions.data"></Question>
            <Pagination :links="questions.links" />
        </Master>
    </div>
</template>

<script>
import Master from "../Layouts/Master.vue";
import Question from "../Components/Question.vue";
import Pagination from "../Components/Pagination.vue";
import { Link } from '@inertiajs/inertia-vue3'
    export default {
        name: 'UserQuestion',
        components: {
            Master,Link,Question,Pagination
        },
        data () {
            return {
                questions : '',
            }
        },
        created () {
            this.questions = this.$page.props.questions;
        }
    }
</script>

<style lang="stylus" scoped>

</style>
