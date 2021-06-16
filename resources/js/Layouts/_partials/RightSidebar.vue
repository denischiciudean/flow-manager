<template>
    <aside class="hidden xl:block xl:col-span-4">
        <div class="sticky top-4 space-y-4">
            <section aria-labelledby="who-to-follow-heading">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h2 id="who-to-follow-heading" class="text-base font-bold text-gray-900">
                            Mesaje Primite
                        </h2>
                        <div class="mt-6 flow-root">
                            <ul class="-my-4 divide-y divide-gray-200">
                                <li v-for="message in messages" :key="message.id"
                                    class="flex items-center py-4 space-x-3 border-b border-1">
                                    <div class="min-w-0 flex-1 flex-grow">
                                        <p class="text-sm font-medium text-gray-900">
                                            <span class="text-gray-500 font-bold">Nota : {{ message.task.title }}</span>
                                            <br>
                                            <span :href="message.href">{{ message.content.substr(0, 70) }}...</span>
                                            <a href="#" class="text-gray-500 text-xs float-right">Citeste >>> </a>
                                        </p>
                                        <div class="mt-2">
                                            @{{ message.created_by.name }} acum
                                            {{ parseInt(((Date.now() / 1000 - message.created_at) / 60)) }} minute
                                        </div>
                                    </div>
                                    <hr>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-6">
                            <a href="#"
                               class="w-full block text-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                View all
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </aside>
</template>

<script>
const messages = [
    {
        created_by: {
            name: 'User Name',
            id: 1
        },
        task: {
            title: 'Titlu Task',
            id: 1
        },
        date: '12.01.2020 14:15',
        content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        message_id: 1,
        href: '#',
        created_at: 1623319742
    },

    {
        created_by: {
            name: 'User Name',
            id: 1
        },
        task: {
            title: 'Titlu Task',
            id: 1
        },
        date: '12.01.2020 14:15',
        content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        message_id: 1,
        href: '#',
        created_at: 1623319742
    },

    {
        created_by: {
            name: 'User Name',
            id: 1
        },
        task: {
            title: 'Titlu Task',
            id: 1
        },
        date: '12.01.2020 14:15',
        content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        message_id: 1,
        href: '#',
        created_at: 1623319742
    },
    // More people...
]
export default {
    name: "RightSidebar",
    data() {
        return {
            messages,
        }
    }
}
</script>

<style scoped>

</style>
