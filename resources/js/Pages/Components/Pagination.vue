<template>
    <div class="card border-0 p-2 d-inline-block mt-3" style="border-radius: 15px">
        <nav aria-label="Page navigation example">
            <ul class="pagination mb-0">
                <li v-for="(link,index) in links" :key="index"  class="page-item" :class="{ active:link.active }">
                    <Link v-if="link.label.includes('Previous')" class="page-link border-0" :href="link.url">Previous</Link>
                    <Link v-else-if="link.label.includes('Next')" class="page-link border-0" :href="link.url">Next</Link>
                    <Link v-else class="page-link border-0" :href="link.url">{{ link.label }}</Link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
    export default {
        name: "Pagination",
        components: {
            Link
        },
        props: {
            links: {
                type: Array,
            },
        },
    }
</script>

<style  scoped>
    .page-item{
        border-radius: 5px !important;
        overflow: hidden;
    }
</style>
