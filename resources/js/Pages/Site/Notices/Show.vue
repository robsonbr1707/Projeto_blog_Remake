<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    
const props = defineProps({
    notice: Object,
    hasLike: Object,
    notices: Object,
    comments: Object,
    flash: Object
});

const form = useForm({
    comment: '',
    notice_id: props.notice.id,
    like: '',
});

function submitComment() 
{
    form.post(route('site.notice.comment'));
        return form.reset('comment');
};

function submitLike()
{
    form.post(route('site.notice.like'));
}

</script>
    
<template>
    <Head title="Noticia"></Head>
    <AppLayout>

        <div class="p-5 my-2 flex justify-around flex-wrap">
            
            <!----Notícia---->
            <div class="w-full xl:w-2/3 rounded overflow-hidden px-10">
                <div class="max-w-7xl mx-auto py-2 my-1 bg-green-600 overflow-hidden shadow-sm sm:rounded-lg"
            v-show="$page.props.flash.success">
                    <p class="p-2 text-white">{{$page.props.flash.success}}</p>
                </div>
                <div>
                    <h1 class="text-4xl text-gray-900 font-bold my-2 py-2 border-b-2">{{notice.title}}</h1>
                </div>
                <figure>
                    <img :src="'/storage/'+notice.image" :alt="notice.title" class="w-11/12 sm:w-full lg:w-3/4
                    h-96 lg:max-h-96 object-scale-down">
                </figure>
                <div class="py-6 my-2">
                    <p class="font-semibold text-gray-700 text-xl">
                    {{notice.description}} Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis reiciendis nostrum beatae architecto natus ipsum dignissimos quasi dolore! Quos, labore non? Dolores repellat provident, nemo dolore aliquam itaque quasi unde.
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta dignissimos voluptatum suscipit cumque. Voluptatem autem iure quis nesciunt inventore esse dolorem, praesentium ipsum, necessitatibus eveniet fugit maxime, hic quasi ut!
                    </p>
                </div>
                <div class="">
                    <form @submit.prevent="submitLike" v-if="!hasLike">
                        <div className="mt-4">
                            <BreezeInput type="hidden" v-model="form.notice_id" />
                            <button
                                type="submit"
                                className="px-6 py-2 font-bold flex text-white bg-green-500 hover:bg-green-600 rounded">
                                <p class="text-2xl">
                                    Curtir Notícia
                                </p>
                                <div class="">
                                    <svg class="w-10 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                            </button>
                        </div>
                    </form>
                    <div class="px-6 py-2 w-40 font-bold flex text-white bg-blue-500 hover:bg-blue-600 rounded" v-else>
                        <h1>Notícia curtida</h1>
                    </div>
                </div>
                <!----Comentarios---->

                <div class="my-1 py-5">
                    <div class="pb-2 mb-10">
                        <h1 class="text-2xl font-bold">Comentarios sobre a Notícia</h1>
                    </div>

                    <div class="flex flex-wrap w-full xl:w-full p-3 mt-5 border border-gray-300" v-for="comment in comments" :key="comment.id">
                        <figure>
                            <img src="https://cdn-icons-png.flaticon.com/512/17/17004.png" alt="Usuario" class="w-12 h-12">
                        </figure>
                        <p class="m-3 font-bold">{{comment.user.name}}</p>
                        <p class="w-full ml-14 px-1">{{comment.comment}}</p>
                        <span class="ml-14 p-1 text-gray-500 text-sm">Comentado em <strong>{{comment.created_at}}</strong></span>
                    </div>
                    <div class="" v-show="comments.length == 0">
                        <h1 class="text-lg font-bold">Seja o primeiro a Comentar!</h1>
                    </div>
                </div>

                <!----Comentar---->
                <div class="">
                    <p class="text-lg">Oque achou da Notícia? <strong class="text-2xl">Comente!</strong> </p>
                    <form name="nameForm" @submit.prevent="submitComment">
                        <BreezeInput type="hidden" v-model="form.notice_id" />
                        <textarea v-model="form.comment" id="comment" cols="10" rows="5" class="mt-1 block w-full">
                        </textarea>
                        <span className="text-red-600" v-if="form.errors.comment">
                            {{ form.errors.comment }}
                        </span>
                        <div className="mt-4">
                            <button
                                type="submit"
                                className="px-6 py-2 font-bold text-white bg-green-500 rounded">
                                Comentar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!----Ultimas Noticias---->
            <div class="w-full xl:w-1/4 rounded overflow-hidden">
                <h1 class="m-2 p-2 text-2xl font-semibold">Ultimas notícias</h1>
                <Link class="m-2 p-2 flex hover:bg-gray-200 border-b-2 border-gray-300" v-for="lastNotice in notices" :key="lastNotice.id" :href="route('site.notice.show', lastNotice)">
                    <figure>
                        <img :src="'/storage/'+lastNotice.image" :alt="lastNotice.title" class="w-24 h-24 object-cover">
                    </figure>
                    <div class="px-6 py-4 w-full">
                        <h2 class="text-gray-700 font-semibold text-lg">
                        {{lastNotice.title}}
                        </h2>
                        <span class="text-gray-500 text-sm">Criado em <strong>{{lastNotice.created_at}}</strong></span>
                        <div class="flex">
                            <div>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            </div>
                            <div>
                                {{lastNotice.comments.length}}
                            </div>
                            <div class="ml-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <div>
                                {{lastNotice.users.length}}
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