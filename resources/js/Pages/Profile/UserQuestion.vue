<template>
    <div>
        <Master>
            <Question :questions="questions"></Question>
        </Master>
    </div>
</template>

<script>
import Master from "../Layouts/Master.vue";
import Question from "../Components/Question.vue";
import { Link } from '@inertiajs/inertia-vue3'
    export default {
        name: 'UserQuestion',
        components: {
            Master,Link,Question,
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
