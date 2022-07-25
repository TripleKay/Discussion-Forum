<template>
    <div>
        <Master>
            <div class="card border-0 mb-4"  style="border-radius: 15px;">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0 py-2">Ask Question</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createQuestion">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input v-model="title" type="text" class="form-control" style="border-radius: 15px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea v-model="description" name="" class="form-control" id=""  rows="3" style="border-radius: 15px;"></textarea>
                        </div>
                        <div class="mb-3">
                            <div v-for="tag in $page.props.tags" :key="tag.id" class="form-check mb-2">
                                <input v-model="tags" class="form-check-input" type="checkbox" :value="tag.id" multiple>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ tag.name }}
                                </label>
                            </div>
                        </div>

                        <button class="btn btn-primary float-end mt-3" :disabled="loading">
                            <div v-show="loading" class="spinner-border spinner-border-sm text-light" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span v-show="loading">wait...</span>
                            <span v-show="!loading">Ask Question</span>
                        </button>
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
        data () {
            return {
                title: '',
                description: '',
                tags: [],
                loading: false,


            }
        },
        methods: {
            createQuestion () {
                this.loading = true;
                var data = new FormData;
                data.append('title',this.title);
                data.append('description',this.description);
                data.append('tags',this.tags);
                this.$inertia.post('/question/create',data,{
                    onFinish: () => this.loading = false
                });

            }
        }
    }
</script>

<style lang="stylus" scoped>

</style>
