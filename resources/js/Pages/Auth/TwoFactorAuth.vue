<template>
    <breeze-authenticated-layout>
        <div class="py-12">
            <div class="flex flex-col justify-center h-full">
                <div class="flex flex-row justify-center w-full">
                    <div class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/4 rounded border-solid  shadow bg-white p-3">
                        <div class="text-center">
                            2FA status :
                            <span class="text-white rounded p-1 text-sm font-bold"
                                  v-bind:class="[enabled ? 'bg-green-400' : 'bg-red-400']">
                                {{ enabled ? 'activat' : 'dezactivat' }}
                            </span>
                        </div>

                        <div class="mt-3 text-center" v-if="!enabled">
                            <div class="mt-10">
                                Introduce-ti numarul de telefon
                            </div>
                            <input type="text"
                                   v-model="phone"
                                   class="px-3 mt-4 py-1 border-solid border-2 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-1/2"
                                   placeholder="+40XXXXXXXXX">
                            <button @click="verifyPhone"
                                    v-bind:class="{'disabled' : !sms_sent}"
                                    class=" ml-2 py-2 px-4 rounded bg-green-400 font-bold text-white">
                                Trimite cod
                            </button>
                        </div>

                        <div class="mt-10 text-center" v-if="sms_sent">
                            <div class="mt-10">
                                Introduce-ti codul primit prin SMS
                            </div>
                            <input type="text"
                                   v-model="challenge_code"
                                   class="px-3 mt-4 py-1 border-solid border-2 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-1/2"
                                   placeholder="000000">
                            <button @click="verifyCode"
                                    class=" ml-2 py-2 px-4 rounded bg-green-400 font-bold text-white">
                                Verifica
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

export default {
    name: "TwoFactorAuth",
    components: {BreezeAuthenticatedLayout},
    props: ['user'],
    data() {
        return {
            sendingMessage: false,
            enabled: false,
            phone: '',
            challenge_code: '',
            sms_sent: null
        }
    },
    mounted() {
        this.enabled = !!this.$page.props.auth.user['phone_verified_at']
    },
    methods: {
        verifyPhone() {
            this.sendingMessage = true;
            if (!this.phone || this.phone.length != 12) {
                this.sendingMessage = false;
                return;
            }
            axios.post('/verify-phone', {phone: this.phone}).then((res) => {
                this.sms_sent = res.data.data.success
                this.sendingMessage = false;
            }).catch(() => {
                this.sendingMessage = false;
            });
        },
        verifyCode() {
            console.log(this.challenge_code.length)
            this.$inertia.post('/verify-code', {code: this.challenge_code});
        }
    }
}
</script>

<style scoped>

</style>
