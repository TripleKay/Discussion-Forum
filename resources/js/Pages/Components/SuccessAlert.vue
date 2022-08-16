<template>
    <div>

    </div>
</template>

<script>
import Swal from 'sweetalert2'
    export default {
        name: 'SuccessAlert',
        props: {
            title: {
                type: String,
                default: 'Successfully!'
            }
        },
        methods: {
            showToast () {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: 'success',
                    title: this.title
                    })
            }
        },
        created(){
            this.showToast();
        }
    }
</script>

<style lang="stylus" scoped>

</style>
