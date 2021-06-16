<template>
    <div class=" flex flex-col">
        <div>
            <h1 class="text-center my-5 text-2xl">Nota de Constatare</h1>
        </div>
        <div class="mt-4 flex flex-row justify-center" v-if="!is_display">
            <div class="my-3">
                <button @click="complete" class="py-1 px-3 bg-yellow-400 rounded-lg text-white font-bold">Termina
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Button from "../../Components/Button";

export default {
    name: "NotaConstatareNext",
    components: {Button},
    props: [
        'department',
        'workflow_id',
        'workflow_slug',
        'step',
        'step_data',
        'is_display',
    ],
    mounted() {
        console.log(this.previous_steps)
    },
    methods: {
        complete() {
            this.$inertia.post('/note/finish-step',
                {
                    step_id: this.step.id,
                    data: []
                }
            );
        }
    }
}
</script>

<style scoped>

</style>
