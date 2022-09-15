<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Pagination from '@/components/Shared/Pagination.vue';
    
const props = defineProps({
    post: Object,
    hasLike: Object,
    records: Object,
    notices: Object,
    flash: Object
});

const form = useForm({
    post_id: props.post.id,
    like: ''
});

function submit()
{
    form.post(route('site.post.like'));
}

</script>

<template>
    <Head title="Post"></Head>
    <AppLayout>
        <div class="p-5 my-2 flex justify-around flex-wrap">
            
            <!----Post---->
            <div class="w-full xl:w-2/3 rounded overflow-hidden px-10">
                <div class="max-w-7xl mx-auto py-2 my-1 bg-green-600 overflow-hidden shadow-sm sm:rounded-lg"
            v-show="$page.props.flash.success">
                    <p class="p-2 text-white">{{$page.props.flash.success}}</p>
                </div>
                <div>
                    <h1 class="text-4xl text-gray-900 font-bold my-2 py-2 border-b-2">{{post.title}}</h1>
                </div>
                <figure>
                    <img :src="'/storage/'+post.image" :alt="post.title" class="w-11/12 sm:w-full lg:w-3/4 lg:h-full object-scale-down">
                </figure>
                <div class="py-6 my-2">
                    <p class="font-semibold text-gray-700 text-xl">
                    {{post.resume}} Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis reiciendis nostrum beatae architecto natus ipsum dignissimos quasi dolore! Quos, labore non? Dolores repellat provident, nemo dolore aliquam itaque quasi unde.
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta dignissimos voluptatum suscipit cumque. Voluptatem autem iure quis nesciunt inventore esse dolorem, praesentium ipsum, necessitatibus eveniet fugit maxime, hic quasi ut!
                    </p>
                </div>
                <div class="">
                    <form @submit.prevent="submit" v-if="!hasLike">
                        <div className="mt-4">
                            <BreezeInput type="hidden" v-model="form.post_id" />
                            <button
                                type="submit"
                                className="px-6 py-2 font-bold flex text-white bg-green-500 hover:bg-green-600 rounded">
                                <p class="text-2xl">
                                    Curtir Publicação
                                </p>
                                <div class="">
                                    <svg class="w-10 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                            </button>
                        </div>
                    </form>
                    <div class="px-6 py-2 w-52 font-bold flex text-white bg-blue-500 hover:bg-blue-600 rounded" v-else>
                        <h1>Publicação curtida</h1>
                    </div>
                </div>
                <!----Registros do post---->
                <div class="w-full xl:w-full rounded overflow-hidden">
                    <div class="m-2 p-2 border-b-2 border-gray-300" v-for="record in records.data" :key="record.id">
                        <h2 class="text-gray-800 font-semibold text-3xl py-2">
                            {{record.title}}
                            </h2>
                        <figure>
                            <img :src="'/storage/'+record.image" :alt="record.title" class="w-10/12 lg:h-full object-scale-down">
                        </figure>
                        <div class="py-4">
                            <p class="font-semibold text-gray-700 text-xl">{{record.description}}</p>
                        </div>
                        <div class="px-6 py-4">
                            <span class="text-gray-500 text-sm">Criado em <strong>{{record.created_at}}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="mt-5" v-show="records.data.length >= 3">
                    <Pagination :links="records.links" />
                </div>
            </div>

            <!----Ultimas Noticias---->
            <div class="w-full xl:w-1/4 rounded overflow-hidden">
                <h1 class="m-2 p-2 text-2xl font-semibold">Ultimas notícias</h1>
                <Link class="m-2 p-2 flex hover:bg-gray-200 border-b-2 border-gray-300" v-for="notice in notices" :key="notice.id" :href="route('site.notice.show', notice)">
                    <figure>
                        <img :src="'/storage/'+notice.image" :alt="notice.title" class="w-24 h-24 object-cover">
                    </figure>
                    <div class="px-6 py-4 w-full">
                        <h2 class="text-gray-700 font-semibold text-lg">
                        {{notice.title}}
                        </h2>
                        <span class="text-gray-500 text-sm">Criado em <strong>{{notice.created_at}}</strong></span>
                        <div class="flex">
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
                <div class="m-5 w-full text-center text-blue-700 font-bold text-2xl" v-show="notices.length >= 4">
                    <Link tabIndex="1" :href="route('site.notice.index')">
                        Ver mais
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>