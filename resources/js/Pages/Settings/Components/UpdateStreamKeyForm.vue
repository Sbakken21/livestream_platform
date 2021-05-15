<template>
    <jet-form-section @submitted="updateStreamKey">
        <template #title>
            Stream Key
        </template>

        <template #description>
            Use this key to connect to streaming server. Reset to receive a new key. DO NOT SHARE THIS KEY.
        </template>

        <template #form>
            <div class="col-span-6">
                <jet-input class="w-5/6" id="stream" :type="keyType" :value="stream_key" readonly />
                <button class="align-middle ml-2 outline-none focus:outline-none" type="button" @click="setType" v-html="setIcon()"></button>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Key reset.
            </jet-action-message>
            <jet-button type="submit" :class="{ 'opacity-25': form.processing }" class="ml-4" :disabled="form.processing">
                Reset
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'

    export default {
        props: {
            stream_key: {
                type: String,
            }
        },
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        data() {
            return {
                showText: this.setIcon,
                keyType: 'password',
                form: this.$inertia.form({}),
            }
        },

        methods: {
            updateStreamKey() {
                this.form.post(route('settings.resetKey'));
            },

            setType() {
                this.keyType = this.keyType === 'password' ? 'text' : 'password';
                this.showText = this.keyType === 'password' ? 'Show' : 'Hide';
                this.setIcon();
            },

            setIcon() {
                if(this.keyType === 'password'){
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>`;
                }

                return `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>`;
            }
        },
    }
</script>