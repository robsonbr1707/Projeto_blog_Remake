<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import Pagination from '@/components/Shared/Pagination.vue';
    
    defineProps({
        posts: Object,
        flash: Object,
    });
    const form = useForm();
    function destroy(id) {
        if (confirm("Deseja Excluir o Post?")) {
            form.delete(route('posts.destroy', id));
        }
    }
</script>

<template>
    
    <Head title="Posts"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Publicações
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
                        <div className="mb-6">
                            <Link
                                className="text-left px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                :href="route('posts.create')">
                                Criar Publicação
                            </Link>
                            <p class="text-center" v-show="posts.data.length == 0">Nenhum Post Encontrado</p>
                        </div>
                        <table className="table-fixed w-full mt-4" v-show="posts.data.length >= 1">
                            <thead>
                                <tr className="bg-gray-100 text-left">
                                    <th className="px-4 py-2 w-12">#</th>
                                    <th className="px-4 py-2 w-96">Título</th>
                                    <th className="px-4 py-2 w-32">Imagem</th>
                                    <th className="px-4 py-2 w-20">Registros</th>
                                    <th className="px-4 py-2 w-96 text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in posts.data" :key="post.id">
                                    <td className="border px-4 py-2">{{ post.id }}</td>
                                    <td className="border px-4 py-2">{{ post.title }}</td>
                                    <td className="border px-4 py-2">
                                        <a :href="'storage/'+post.image" target="_blank" className="leading-5 font-semibold text-green-800 ">
                                            Ver Imagem
                                        </a>
                                    </td>
                                    <td className="border px-4 py-2 text-center">{{post.records.length}}</td>
                                    <td className="border px-4 py-2 text-center">
                                        <Link
                                            tabIndex="1"
                                            className="px-4 py-2 mr-2 text-sm text-white bg-blue-500 rounded"
                                            :href="route('posts.edit', post.id)">
                                            Editar
                                        </Link>
                                        <Link
                                            tabIndex="1"
                                            className="px-4 py-2 mr-2 text-sm text-white bg-blue-500 rounded"
                                            :href="route('records.index', {post_id: post.id})">
                                            Registros
                                        </Link>
                                        <button
                                            @click="destroy(post.id)"
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
                    <Pagination :links="posts.links" />
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>