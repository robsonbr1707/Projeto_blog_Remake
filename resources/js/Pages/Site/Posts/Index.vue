<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    posts: Object,
});

</script>

<template>
<AppLayout>
    <Head title="todos-posts"></Head>
    <div class="flex flex-wrap justify-center w-11/12 mx-auto my-4 bg-white">
            <Link class="m-4 w-full lg:w-3/4 xl:w-2/5 p-2 bg-gray-100 hover:bg-gray-200" v-for="post in posts" :key="post.id" tabIndex="1" :href="route('site.post.show', post)">
                <figure class="">
                    <img :src="'/storage/'+post.image" :alt="post.title" class="w-full h-96 object-cover">
                </figure>
                <div class="p-4">
                    <div class="">
                        <h1 class="text-3xl font-bold">{{post.title}}</h1>
                        <span class="text-gray-500 text-sm">Criado em <strong>{{post.created_at}}</strong></span>
                    </div>
                </div>
                <div class="flex py-4">
                    <div class="ml-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <div>
                        {{post.users.length}}
                    </div>
                </div>
            </Link>
        </div>
</AppLayout>
</template>