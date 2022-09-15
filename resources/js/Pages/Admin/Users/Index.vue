<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import Pagination from '@/components/Shared/Pagination.vue';
    
    defineProps({
        users: Object,
        flash: Object,
    });
    const form = useForm();
    function destroy(id) {
        if (confirm("Deseja Excluir o Usuario?")) {
            form.delete(route('users.destroy', id));
        }
    }
</script>

<template>
    
    <Head title="Dashboard"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Usuarios
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto py-2 my-1 bg-green-500 overflow-hidden shadow-sm sm:rounded-lg"
            v-show="$page.props.flash.success">
                <p class="p-2 text-white">{{$page.props.flash.success}}</p>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link
                                className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                :href="route('users.create')">
                                Criar Usuario
                            </Link>
                        </div>
                        <table className="table-fixed w-full mt-4">
                            <thead>
                                <tr className="bg-gray-100 text-left">
                                    <th className="px-4 py-2 w-20">#</th>
                                    <th className="px-4 py-2">Nome</th>
                                    <th className="px-4 py-2">Email</th>
                                    <th className="px-4 py-2">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td className="border px-4 py-2">{{ user.id }}</td>
                                    <td className="border px-4 py-2">{{ user.name }}</td>
                                    <td className="border px-4 py-2">{{ user.email }}</td>
                                    <td className="border px-4 py-2">
                                        <Link
                                            tabIndex="1"
                                            className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                            :href="route('users.edit', user.id)">
                                            Editar
                                        </Link>
                                        <button
                                            @click="destroy(user.id)"
                                            tabIndex="-1"
                                            type="button"
                                            className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-5">
                    <Pagination :links="users.links" />
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>