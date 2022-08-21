<template>
    <div>
        <Master>
            <div class="mb-4 border-0 card"  style="border-radius: 15px;">
                <div class="bg-transparent card-header">
                    <h5 class="py-2 mb-0">Ask Question</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createQuestion">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input v-model="title" type="text" class="form-control" :class="[ errors.title ? 'border border-danger' : '' ]" style="border-radius: 15px;">
                            <small class="text-danger" v-if="errors.title">{{ errors.title}}</small>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea v-model="description" name="" class="form-control" :class="[ errors.description ? 'border border-danger' : '' ]" id=""  rows="3" style="border-radius: 15px;"></textarea>
                            <small class="text-danger" v-if="errors.description">{{ errors.description }}</small>
                        </div>
                        <div class="mb-3">
                            <div v-for="tag in $page.props.tags" :key="tag.id" class="mb-2 form-check">
                                <input v-model="tags" class="form-check-input"  :class="[ errors.tags ? 'border border-danger' : '' ]" type="checkbox" :value="tag.id" multiple>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ tag.name }}
                                </label>
                            </div>
                            <small class="text-danger" v-if="errors.tags">{{ errors.tags }}</small>
                        </div>

                        <button class="mt-3 btn btn-primary float-end" :disabled="loading">
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
        props: {
            errors: Object
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
