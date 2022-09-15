<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/components/Shared/Pagination.vue';

defineProps({
    posts: Object,
    notices: Object
});

</script>

<template>
    <Head title="Tela Inicial"></Head>
    <AppLayout>
        <!--Posts-->
        <div class="flex flex-wrap justify-center w-full xl:w-11/12 mx-auto my-4 bg-white">
            <div class="p-3 my-2" v-show="posts.length == 0">
                <h1 class="font-bold text-2xl">Nenhuma Publicação encontrada</h1>
            </div>
            <Link class="m-4 w-full p-2 bg-gray-100 hover:bg-gray-200 lg:w-5/12" v-for="post in posts" :key="post.id" tabIndex="1" :href="route('site.post.show', post)">
                <figure class="">
                    <img :src="'storage/'+post.image" :alt="post.title" class="w-full h-96 object-cover">
                </figure>
                <div class="p-4">
                    <div class="">
                        <h1 class="text-3xl font-bold">{{post.title}}</h1>
                        <span class="text-gray-500 text-sm">Criado em <strong>{{post.created_at}}</strong></span>
                    </div>
                </div>
                <div class="flex px-4">
                    <div class="ml-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <div>
                        {{post.users.length}}
                    </div>
                </div>
            </Link>
            <div class="m-5 w-full text-center text-blue-700 font-bold text-2xl" v-show="posts.length >= 4">
                <Link tabIndex="1" :href="route('site.post.index')">
                    Ver mais
                </Link>
            </div>
        </div>
        
        <!--Notícias-->
        <div class="w-11/12 mx-auto bg-white">
            <div class="rounded overflow-hidden">
                <div class="bg-gray-200 p-1">
                    <h1 class="m-2 p-2 text-3xl font-semibold">Últimas notícias</h1>
                </div>
                <Link class="m-2 p-2 flex hover:bg-gray-200 border-b-2 border-gray-300" v-for="notice in notices.data" :key="notice.id" :href="route('site.notice.show', notice)">
                    <figure>
                        <img :src="'/storage/'+notice.image" :alt="notice.title" class="w-32 h-32 object-cover">
                    </figure>
                    <div class="px-6 py-4">
                        <h2 class="text-gray-700 font-semibold text-2xl">
                        {{notice.title}}
                        </h2>
                        <span class="text-gray-500 text-sm">Criado em <strong>{{notice.created_at}}</strong></span>
                        
                        <div class="flex py-4">
                            <div>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            </div>
                            <div>
                                {{notice.comments.length}}
                            </div>
                            <div class="ml-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <div>
                                {{notice.users.length}}
                            </div>
                        </div>
                    </div>
                </Link>
                <div class="mt-5" v-show="notices.data.length >= 6">
                    <Pagination :links="notices.links" />
                </div>
            </div>
            <div class="p-3 my-2"  v-show="notices.data.length == 0">
                <h1 class="font-bold text-2xl">Nenhuma notícia encontrada</h1>
            </div>
        </div>
    </AppLayout>
</template>
