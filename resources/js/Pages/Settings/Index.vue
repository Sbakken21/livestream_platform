<template>
    <app-layout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <update-stream-key-form :stream_key="stream_key" />
        </div>        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import UpdateStreamKeyForm from '@/Pages/Settings/Components/UpdateStreamKeyForm'

    export default {
        props: {
            stream_key: {
                type: String,
            }
        },
        components: {
            AppLayout,
            UpdateStreamKeyForm,
        }
    }
</script>
