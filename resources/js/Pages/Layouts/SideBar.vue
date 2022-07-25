<template>
    <div>
        <div v-show="isProfileUrl == false" class="card border-0" style="border-radius: 15px;">
            <div class="card-header bg-transparent">
                <h5 class="mb-0 py-2">All Tags</h5>
            </div>
            <div class="card-body">
                <div class="" v-for="tag in $page.props.tags" :key="tag.id">
                    <Link href="" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">{{ tag.name }}</Link>
                </div>
            </div>
        </div>

        <div v-show="isProfileUrl == true" class="card border-0" style="border-radius: 15px;">
            <div class="card-body">
                <div class="">
                    <Link :href="route('profile.edit')" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Edit Profile</Link>
                    <Link :href="route('profile.userQuestion')" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Your Questions</Link>
                    <Link href="" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Answered Questions</Link>
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
        },
        computed: {
            isProfileUrl () {
                var url = location.pathname;
                var exp = '/profile/.*';
                var result = url.match(exp);
                if(result != null){
                    return true;
                }
                return false;
            }
        },
    }
</script>

<style lang="stylus" scoped>

</style>
