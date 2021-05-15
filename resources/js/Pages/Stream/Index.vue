<template>
    <app-layout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex flex-row flex-wrap justify-center">
                <stream-tile v-for="(stream, index) in streams" :key="index" :data="stream" />
            </div>
        </div>        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import StreamTile from '@/Pages/Stream/Components/StreamTile'

    export default {
        props: {
            streams: {
                type: Array,
                default: () => []
            }
        },

        components: {
            AppLayout,
            StreamTile,
        }
    }
</script>
