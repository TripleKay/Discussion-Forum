<template>
    <div>
        <!-- admin side bar  -->
        <div class="mb-3 border-0 card" style="border-radius: 15px;">
            <div class="bg-transparent card-header">
                <h5 class="py-2 mb-0">Admin Dashboard</h5>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <Link :href="route('dashboard')" :class="{ 'active': route().current('dashboard') }" class="mb-2 btn me-3" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-users me-2"></i>Dashboard</Link>
                    <Link :href="route('admin.userList')" :class="{ 'active': route().current('admin.userList') }" class="mb-2 btn me-3" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-users me-2"></i>User Lists</Link>
                    <Link :href="route('admin.questionList')" :class="{ 'active': route().current('admin.questionList') }" class="mb-2 btn me-3" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-question-circle me-2"></i>Questions</Link>
                    <Link :href="route('admin.tagList')" :class="{ 'active': route().current('admin.tagList') }" class="mb-2 btn me-3" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-hashtag me-2"></i>Tags</Link>
                    <Link :href="route('profile.edit')" :class="{ 'active': route().current('profile.edit') }" class="mb-2 btn me-3" style="border: .5px solid #00000010; border-radius: 15px;"><i class="fas fa-user-edit me-2"></i>Profile</Link>

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
    }
</script>

<style scoped>
.active {
    background: var(--bs-primary);
    color: #fff;
}

</style>
