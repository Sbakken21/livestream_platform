<template>
    <app-layout>
        <video-player :id="id" />
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import VideoPlayer from '@/Pages/Stream/Components/VideoPlayer'
    export default {
        props: {
            id: {}
        },

        components: {
            AppLayout,
            VideoPlayer,
        },

        mounted(){
            Echo.channel(`stream.${this.id}`);
        },

        beforeUnmount(){
            Echo.leave(`stream.${this.id}`);
        }
    }
</script>