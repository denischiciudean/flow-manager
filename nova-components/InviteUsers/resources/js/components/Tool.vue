<template>
    <div>
        <heading class="mb-6">Invite Users</heading>

        <card
            class="bg-white flex flex-col items-center py-3 px-2"
            style="min-height: 300px"
        >
            <div class="text-gray-700 w-2/3">
                <div class="flex items-center justify-between">
                    <div class="mb-1 md:mb-0 w-1/3 float-left">
                        <label for="fullname">Full name</label>
                    </div>
                    <div class="w-2/3">
                        <input
                            v-model="form.name"
                            class="w-full h-8 px-2 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline"
                            type="text" placeholder="Nume Complet" id="fullname"/>
                    </div>
                </div>
            </div>

            <div class="text-gray-700 w-2/3 mt-3">
                <div class="flex items-center justify-between">
                    <div class="mb-1 md:mb-0 w-1/3 ">
                        <label for="email">Email</label>
                    </div>
                    <div class="w-2/3">
                        <input
                            v-model="form.email"
                            class="w-full h-8 px-2 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline"
                            type="text" placeholder="mihaipopescu@email.com" id="email"/>
                    </div>
                </div>
            </div>

            <div class="text-gray-700 w-2/3 mt-3">
                <div class="flex items-center justify-between">
                    <div class="mb-1 md:mb-0 w-1/3">
                        <label for="nr_telefon">Numar Telefon</label>
                    </div>
                    <div class="w-2/3 ">
                        <input
                            v-model="form.phone"
                            class="w-full h-8 px-2 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline"
                            type="text" placeholder="+40740647936" id="nr_telefon"/>
                    </div>
                </div>
            </div>

            <div class="inline-block w-2/3 mt-3">
                <div class="w-full md:flex md:items-center justify-between text-gray-700">
                    <div class="mb-1 md:mb-0 w-1/3">
                        <label for="nr_telefon">Departament</label>
                    </div>
                    <select
                        class="w-2/3 h-8 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                        v-model="form.department_id"
                        placeholder="Regular input">
                        <option v-for="department in departments" v-bind:key="department.slug"
                                v-bind:value="department.id">
                            {{
                                department.name
                            }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="inline-block w-2/3 mt-3">
                <div class="w-full md:flex md:items-center justify-between text-gray-700">
                    <div class="mb-1 md:mb-0 w-1/3">
                        <label for="nr_telefon">Role</label>
                    </div>
                    <select
                        class="w-2/3 h-8 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                        v-model="form.role"
                        placeholder="Regular input">
                        <option v-for="role in roles" v-bind:key="role.name"
                                v-bind:value="role.name">
                            {{
                                role.display_name
                            }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="flex justify-center mt-3">
                <button class="px-3 py-2 bg-blue-400 text-white font-bold rounded" @click="inviteUser">Invita</button>
            </div>

        </card>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
            title: 'InviteUsers',
        }
    },
    data() {
        return {
            departments: [],
            roles: [],
            form: {
                name: '',
                email: '',
                department_id: 1,
                phone: '',
                role: ''
            }
        }
    },
    mounted() {
        this.getDepartments()
        this.getRoles()
    },
    methods: {
        async getDepartments() {
            let res = await Nova.request().get('/nova-vendor/invite-users/user-departments').then(res => res.data)
            this.form.department_id = res.data[0].id;
            this.departments = res.data
        },
        async getRoles() {
            let res = await Nova.request().get('/nova-vendor/invite-users/user-roles').then(res => res.data)
            this.form.role = res.data[0].name;
            this.roles = res.data
        },
        async inviteUser() {
            await axios.post('/nova-vendor/invite-users/invite-user', this.form).then(res => {
                if (res.data.success) {
                    Nova.success("Utilizator Invitat cu Success")
                }
            }).catch(error => {
                let errors = Object.keys(error.response.data.errors).map((key) => [key, error.response.data.errors[key]])
                errors.map(it => Nova.error(it[1][0]));
            });
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
