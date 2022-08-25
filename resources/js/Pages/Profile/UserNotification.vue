<template>
    <div>
        <Master>
            <div  class="mb-2 border-0 card" style="border-radius: 15px">
                <div class="card-body">
                    <Link v-for="noti in notifications" :key="noti.id" :href="route('question.detail',{'slug':noti.data.slug,'notiId': noti.id})" :class="noti.read_at == null ? 'unRead' : '' " class="btn w-100 mb-2 notiBox"  style="border: .5px solid #00000010; border-radius: 15px;">
                        <div class="d-flex align-items-center">
                            <img :src="'/uploads/users/'+noti.data.commentUserImage" class="rounded-circle" alt="" srcset="" style="width: 40px ; height: 40px;">
                            <div class="mx-2 d-flex">
                                <p class="mb-0 text-danger text-start">"{{ noti.data.commentUserName }}"<span class="text-secondary">{{ noti.data.message }}</span><span class="">"{{ noti.data.title }}"</span><span class="text-secondary ms-2 text-nowrap">{{ changeDateFormat(noti.created_at) }} ago</span></p>
                            </div>
                            <Link :href="route('markAsRead',noti.id)" v-show="noti.read_at == null" class="btn btn-sm bg-white text-nowrap ">Mark as Read</Link>
                        </div>
                    </Link>
                </div>
            </div>
        </Master>
    </div>
</template>


<script>
import Master from "../Layouts/Master.vue";
import { Link } from '@inertiajs/inertia-vue3';

    export default {
        name: "UserNotification",
        components: {
            Master,Link
        },
        data () {
            return {
                notifications: ''
            }
        },
        methods: {
            changeDateFormat (date) {
                const date1 = new Date(date);
                const date2 = Date.now();
                //milli seconds = (ms/1000) = sec
                const diffTime = Math.abs(date2 - date1);
                // sec/60s*60min*24hr //
                // 60s => 1 min //
                // --s => --s/60s (min)// /60min (hr) // /24d (days)
                const diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24));
                return diffDays + " days";
            }
        },
        created(){
            this.notifications = this.$page.props.notifications;
        }
    }
</script>

<style scoped>
    .unRead {
        background: #e9ecef;
    }
    .notiBox:hover{
        border: .5px solid var(--bs-secondary) !important;
    }
</style>
