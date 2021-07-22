<template>
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 md:grid-cols-3">
            <div class="sm:col-span-1" v-for="(agent, i) in agents_user_list">
                <dt class="text-sm font-medium text-gray-500">
                    Agent Constatator {{ i + 1 }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ agent.name }}
                    <!--                                {{ step_data.agent_constatator_1 }}-->
                </dd>
            </div>

            <div class="sm:col-span-1">
                <dt class="text-sm font-bold text-gray-500">
                    Constatare
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ step_data.constatare_seria }}{{ step_data.constatare_nr }}
                </dd>
            </div>

            <hr class="col-span-full">
            <!-- AGENT ECONOMIC-->
            <div class="sm:col-span-1 font-bold">
                <dt class="text-sm  text-gray-500">
                    Agent economic
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ step_data.agent_economic_nume }}
                </dd>
            </div>


            <div class="sm:col-span-2">
                <dt class="text-sm font-bold text-gray-500">
                    Date înregistrare Registrul Comerțului
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    Nr. CI : {{ step_data.registrul_comertului_nr_ci }}
                    <br>
                    CUI : {{ step_data.registrul_comertului_cui }}
                </dd>
            </div>
            <hr class="col-span-full">
            <div class="sm:col-span-1">
                <dt class="text-sm font-bold text-gray-500">
                    Reprezentat de
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ step_data.reprezentant_nume }} {{ step_data.reprezentant_prenume }}
                </dd>
            </div>

            <div class="sm:col-span-1">
                <dt class="text-sm font-bold text-gray-500">
                    In calitate de
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ step_data.reprezentant_calitate_de }}
                </dd>
            </div>


            <hr class="col-span-full">

            <div class="sm:col-span-1">
                <dt class="text-sm font-bold text-gray-500">
                    Mentiuni
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ step_data.mentiuni }}
                </dd>
            </div>

            <div class="sm:col-span-1">
                <dt class="text-sm font-bold text-gray-500">
                    Masuri
                </dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ step_data.masuri }}
                </dd>
            </div>

        </dl>
    </div>
</template>

<script>
export default {
    name: "NotaConstatareSummary",
    props: ['agents_user_list', 'step_data', 'attachments']
}
</script>

<style scoped>

</style>
