<template>
    <div>
        <Master>
            <div class="card border-0 mb-4"  style="border-radius: 15px;">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0 py-2">Ask Question</h5>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" style="border-radius: 15px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="" class="form-control" id=""  rows="3" style="border-radius: 15px;"></textarea>
                        </div>
                        <div class="mb-3">
                            <div v-for="tag in $page.props.tags" :key="tag.id" class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" :value="tag.id">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ tag.name }}
                                </label>
                            </div>
                        </div>

                        <button class="btn btn-primary float-end mt-3">Ask Question</button>
                    </form>
                </div>
            </div>
        </Master>
    </div>
</template>

<script>
import Master from "../Layouts/Master.vue"
    export default {
        name: "QuestionCreate",
        components: {
            Master,
        },
    }
</script>

<style lang="stylus" scoped>

</style>
