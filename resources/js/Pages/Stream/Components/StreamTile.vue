<template>
    <div class="mx-2">
        <inertia-link :href="route('stream.show', data.username)">
            <img src="https://via.placeholder.com/200" alt="placeholder">
        </inertia-link>
        <span class="text-gray-500 font-semibold">{{ data.username }}</span>
    </div>
</template>

<script>
    export default {
        props: {
            data: {
                type: Object,
                default: () => {}
            }
        },


    }
</script>