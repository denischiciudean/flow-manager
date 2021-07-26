<template>
    <div class="mt-4">
        <div v-for="(amenda, index) in amenzi" :key="index">
            <disclosure-pane :title="`Fapta savarsita ${ index+1 }`">
                <div class="font-medium my-2">
                    Incalca prevederile
                </div>
                <div class="px-3 py-5 bg-white sm:p-3 grid grid-cols-6 gap-6">

                    <c-select :options="articole" data_key="prevederi_incalcate"
                              @changed="([key, data]) => modifiedInput(key, data, index)"/>

                    <!--                    <form-text-input label="art"-->
                    <!--                                     class="my-2"-->
                    <!--                                     :fixed_value="disabled ? amenda.prevederi_incalcate_art : undefined"-->
                    <!--                                     @changed="([key, data]) => modifiedInput(key, data, index)"-->
                    <!--                                     data_key="prevederi_incalcate_art"/>-->
                    <!--                    <form-text-input label="lit"-->
                    <!--                                     class="my-2"-->
                    <!--                                     :fixed_value="disabled ? amenda.prevederi_incalcate_lit : undefined"-->
                    <!--                                     @changed="([key, data]) => modifiedInput(key, data, index)"-->
                    <!--                                     data_key="prevederi_incalcate_lit"/>-->
                </div>
                <div class="font-medium my-2">
                    Se sanctioneaza conform
                </div>

                <div class="px-3 py-5 bg-white sm:p-3 grid grid-cols-6 gap-6">

                    <c-select :options="articole"
                              data_key="sanctionare_conform"
                              @changed="([key, data]) => modifiedInput(key, data, index)"/>

                    <!--                    <form-text-input label="art"-->
                    <!--                                     :fixed_value="disabled ? amenda.sanctionare_conform_art : undefined"-->
                    <!--                                     @changed="([key, data]) => modifiedInput(key, data, index)"-->
                    <!--                                     data_key="sanctionare_conform_art"-->
                    <!--                    ></form-text-input>-->

                    <!--                    <form-text-input label="lit"-->
                    <!--                                     :fixed_value="disabled ? amenda.sanctionare_conform_lit : undefined"-->
                    <!--                                     @changed="([key, data]) => modifiedInput(key, data, index)"-->
                    <!--                                     data_key="sanctionare_conform_lit"-->
                    <!--                    ></form-text-input>-->
                </div>

                <div class="font-medium my-2">
                    Cu amenda
                </div>

                <div class="px-3 py-5 bg-white sm:p-3 grid grid-cols-6 gap-6">

                    <form-text-input label="de la"
                                     class="my-2"
                                     :fixed_value="disabled ? amenda.amenda_de : undefined"
                                     @changed="([key, data]) => modifiedInput(key, data, index)"
                                     :colspans="[6, 2]"
                                     data_key="amenda_de"
                    ></form-text-input>

                    <form-text-input label="pana la"
                                     class="my-2"
                                     :fixed_value="disabled ? amenda.amenda_la : undefined"
                                     @changed="([key, data]) => modifiedInput(key, data, index)"
                                     :colspans="[6, 2]"
                                     data_key="amenda_la"
                    ></form-text-input>

                    <form-text-input label="Amenda aplicata"
                                     class="my-2"
                                     :fixed_value="disabled ? amenda.amenda_aplicata : undefined"
                                     @changed="([key, data]) => modifiedInput(key, data, index)"
                                     :colspans="[6, 2]"
                                     data_key="amenda_aplicata"
                    ></form-text-input>

                    <div class="col-span-3">
                        <button @click="remove(index)"
                                class=" py-2 px-2 font-bold bg-red-500 text-sm text-white rounded right ">
                            Sterge fapta {{ index + 1 }}
                        </button>
                    </div>

                </div>
            </disclosure-pane>
        </div>
        <div class="mt-4 flex flex-row justify-between" v-if="!disabled">
            <button @click="add" class="ml-2 px-3 py-1 bg-blue-400 text-white f rounded font-bold">Adauga fapt
                savarsita
            </button>
        </div>

    </div>
</template>

<script>

import FormTextInput from "./FormTextInput";
import DisclosurePane from "../DisclosurePane";
import CSelect from "./CSelect";

export default {
    name: "Amenzi",
    components: {CSelect, DisclosurePane, FormTextInput},
    props: [
        'data_key',
        'fixed_value'
    ],
    data() {
        return {
            amenzi: [],
            articole: []
        };
    },
    computed: {
        disabled() {
            return typeof this.fixed_value != 'undefined'
        }
    },
    mounted() {
        this.articole = this.$page.props.current_step.component_data.articole;
        if (this.fixed_value) {
            this.amenzi = this.fixed_value
        }
    },
    methods: {
        modifiedInput(key, data, index) {
            this.amenzi[index][key] = data;
            this.$emit('changed', [this.data_key, this.amenzi]);
        },
        remove(index) {
            this.amenzi.splice(index, 1);
            this.$emit('changed', [this.data_key, this.amenzi]);
        },
        add() {
            this.amenzi.push({
                prevederi_incalcate: '',
                sanctionare_conform: '',
                amenda_de: 100,
                amenda_la: 100_000,
                amenda_aplicata: 150
            })
        }
    }
}
</script>

<style scoped>

</style>
