<template>
    <div>
        <slot></slot>
        <!-- tags  -->
        <div v-show="isProfileUrl == false" class="mb-3 border-0 card" style="border-radius: 15px;">
            <div class="bg-transparent card-header">
                <h5 class="py-2 mb-0">All Tags</h5>
            </div>
            <div class="card-body">
                <div class="">
                    <Link :href="route('home')" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;">All</Link>
                </div>
                <div class="" v-for="tag in $page.props.tags" :key="tag.id">
                    <Link :href="'/?tag='+tag.slug" :class="{ 'active': $page.url === '/?tag='+tag.slug }" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;">{{ tag.name }}</Link>
                </div>
            </div>
        </div>
        <!-- profile  -->
        <div v-show="isProfileUrl == true" class="mb-3 border-0 card" style="border-radius: 15px;">
             <div class="bg-transparent card-header">
                <h5 class="py-2 mb-0">Your Profile</h5>
            </div>
            <div class="card-body">
                <div class="">
                    <Link :href="route('profile.edit')" :class="{ 'active': route().current('profile.edit') }" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-user-edit me-2"></i>Edit Profile</Link>
                    <Link :href="route('profile.editPassword')" :class="{ 'active': route().current('profile.editPassword') }" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-lock me-2"></i>Change Password</Link>
                    <Link :href="route('showAllNotification')" :class="{ 'active': route().current('showAllNotification') }" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-bell me-2"></i>All Notifications</Link>
                    <Link :href="route('profile.userQuestion')" :class="{ 'active': route().current('profile.userQuestion') }" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;">
                        <i class="fas fa-question-circle me-2"></i>Your Questions</Link>
                    <Link :href="route('showSaveQuestion')" :class="{ 'active': route().current('showSaveQuestion') }" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-heart me-2"></i>Saved Questions</Link>
                </div>
            </div>
        </div>

        <!-- question  -->
        <div class="mb-3 border-0 card" style="border-radius: 15px;">
            <div class="card-body">
                <div class="">
                    <Link href="/?type=answered" :class="{ 'active': $page.url === '/?type=answered'}" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;">Answered Questions</Link>
                    <Link href="/?type=unanswered" :class="{ 'active': $page.url === '/?type=unanswered' }" class="mb-2 btn w-100 text-start" style="border: .5px solid #00000010; border-radius: 15px;">UnAnswered Questions</Link>
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
