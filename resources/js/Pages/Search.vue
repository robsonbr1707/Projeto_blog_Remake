<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/components/Shared/Pagination.vue';

defineProps({
    posts: Object,
    notices: Object,
    search: String,
});
</script>
    
<template>
    <Head title="Busca"></Head>
    <AppLayout>
        <div class="ml-14 p-4">
            <h2 class="text-lg">Buscando Por: <strong class="text-2xl">{{search}}</strong></h2>
        </div>
        <!--Posts-->
        <div class="flex flex-wrap justify-center w-11/12 mx-auto my-4 bg-white">
            <Link class="m-4 w-full lg:w-3/4 xl:w-2/5 bg-gray-100 p-2 hover:bg-gray-200" v-for="post in posts" :key="post.id" tabIndex="1" :href="route('site.post.show', post)">
                <figure class="">
                    <img :src="'storage/'+post.image" :alt="post.title" class="w-full h-96 object-cover">
                </figure>
                <div class="p-4">
                    <div class="">
                        <h1 class="text-3xl font-bold">{{post.title}}</h1>
                        <span class="text-gray-500 text-sm">Criado em <strong>{{post.created_at}}</strong></span>
                    </div>
                </div>
            </Link>
            <div class="p-3 my-2"  v-show="posts.length == 0">
                <h1 class="font-bold text-2xl">Nenhuma Publicação encontrada</h1>
            </div>
        </div>
        <!--Notícias-->
        <div class="w-11/12 mx-auto bg-white">
            <div class="rounded overflow-hidden">
                <div class="bg-gray-200 p-1">
                    <h1 class="m-2 p-2 text-3xl font-semibold">Últimas notícias</h1>
                </div>
                <Link class="m-2 p-2 flex hover:bg-gray-200 border-b-2 border-gray-300" v-for="notice in notices" :key="notice.id" :href="route('site.notice.show', notice)">
                    <figure>
                        <img :src="'/storage/'+notice.image" :alt="notice.title" class="w-32 h-32 object-cover">
                    </figure>
                    <div class="px-6 py-4">
                        <h2 class="text-gray-700 font-semibold text-2xl">
                        {{notice.title}}
                        </h2>
                        <span class="text-gray-500 text-sm">Criado em <strong>{{notice.created_at}}</strong></span>
                    </div>
                </Link>
            </div>
            <div class="p-3 my-2"  v-show="notices.length == 0">
                <h1 class="font-bold text-2xl">Nenhuma notícia encontrada</h1>
            </div>
        </div>
        
    </AppLayout>
</template>
    