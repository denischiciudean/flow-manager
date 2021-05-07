<template>
    <guest>

        <div>
            2FA Code
            <input type="text" class="py-2 px-4 rounded shadow" v-model="code">
            <button class="px-4 py-2 bg-green-500 font-bold rounded text-white ml-2" @click="send">Trimite</button>
        </div>

    </guest>
</template>

<script>
import Guest from '@/Layouts/Guest'

export default {
    components: {Guest},
    name: "TwoFactorAuthChallenge",
    data() {
        return {
            code: ''
        }
    },
    methods: {
        send() {
            this.$inertia.post('/login', {code: this.code})
        }
    }
}
</script>

<style scoped>

</style>
