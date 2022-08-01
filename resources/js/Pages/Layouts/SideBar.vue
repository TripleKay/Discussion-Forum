<template>
    <div>
        <!-- tags  -->
        <div v-show="isProfileUrl == false" class="card border-0 mb-3" style="border-radius: 15px;">
            <div class="card-header bg-transparent">
                <h5 class="mb-0 py-2">All Tags</h5>
            </div>
            <div class="card-body">
                <div class="" v-for="tag in $page.props.tags" :key="tag.id">
                    <Link :href="'/?tag='+tag.slug" :class="{ 'active': $page.url === '/?tag='+tag.slug }" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">{{ tag.name }}</Link>
                </div>
            </div>
        </div>
        <!-- profile  -->
        <div v-show="isProfileUrl == true" class="card border-0 mb-3" style="border-radius: 15px;">
             <div class="card-header bg-transparent">
                <h5 class="mb-0 py-2">Your Profile</h5>
            </div>
            <div class="card-body">
                <div class="">
                    <Link :href="route('profile.edit')" :class="{ 'active': route().current('profile.edit') }" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-user-edit me-2"></i>Edit Profile</Link>
                    <Link href="" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-lock me-2"></i>Change Password</Link>
                    <Link :href="route('profile.userQuestion')" :class="{ 'active': route().current('profile.userQuestion') }" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">
                        <i class="fas fa-question-circle me-2"></i>Your Questions</Link>
                    <Link :href="route('showSaveQuestion')" :class="{ 'active': route().current('showSaveQuestion') }" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-heart me-2"></i>Saved Questions</Link>
                </div>
            </div>
        </div>

        <!-- question  -->
        <div class="card border-0 mb-3" style="border-radius: 15px;">
            <div class="card-body">
                <div class="">
                    <Link href="/?type=answered" :class="{ 'active': $page.url === '/?type=answered'}" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">Answered Questions</Link>
                    <Link href="/?type=unanswered" :class="{ 'active': $page.url === '/?type=unanswered' }" class="btn w-100 text-start mb-2" style="border: .5px solid #00000010; border-radius: 15px;">UnAnswered Questions</Link>
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

<style scoped>
.active {
    background: var(--bs-primary);
    color: #fff;
}

</style>
