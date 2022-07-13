<template>
    <div>
        <div class="card border-0" style="border-radius: 15px;">
            <div class="card-header bg-transparent">
                <h5 class="mb-0 py-2">All Tags</h5>
            </div>
            <div class="card-body">
                <div class="" v-for="tag in $page.props.tags" :key="tag.id">
                    <Link href="" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">{{ tag.name }}</Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
    export default {
        name: "SideBar",
        components: {
            Link
        }
    }
</script>

<style lang="stylus" scoped>

</style>
