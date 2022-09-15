<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/components/Shared/Pagination.vue';

defineProps({
    categories: Object,

});

</script>
    
<template>
    <Head title="Tela Inicial"></Head>
    <AppLayout>
        <div class="my-2">
        <div v-for="(category,index) in categories.data" :key="index">
            <div class="py-2 bg-gray-200">
                <h1 class="text-2xl p-2">{{category.title}}</h1>
            </div>
            <div class="flex flex-wrap px-4">
                <div class="p-4 m-3 w-full xl:w-2/5 bg-gray-200 lg:max-w-full lg:flex"
                v-for="(item,index) in category.notices" :key="index">
                    <figure>
                        <img :src="'/storage/'+item.image" :alt="item.title" class="mx-auto xl:w-full h-72 object-cover">
                    </figure>
                    <div class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
                        <div class="mb-8">
                            <div class="text-gray-900 font-bold text-xl mb-2">{{item.title}}</div>
                                <p class="text-gray-700 text-base">{{item.description}}</p>
                            </div>
                            <div class="">
                                <Link
                                    tabIndex="1"
                                    className="px-4 py-2 mr-2 text-lg text-white bg-gray-700 rounded :hover"
                                    :href="route('site.notice.show', item)">
                                    Visitar Notícia
                                </Link>
                            </div>
                            <div class="text-sm mt-3">
                                <span class="text-gray-500 text-sm">Criado em <strong>{{item.created_at}}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="mt-5">
                <Pagination :links="categories.links" />
            </div>
            -->
        </div>
    </AppLayout>
</template>    