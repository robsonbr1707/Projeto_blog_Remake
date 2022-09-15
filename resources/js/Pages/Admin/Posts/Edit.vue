<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeInput from '@/Components/Input.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import { Inertia } from '@inertiajs/inertia';

    const props = defineProps({
        post: Object,
        errors: Object,
    });
    const form = useForm({
        title: props.post.title,
        resume: props.post.resume,
        image: null
    });
    function submit()
    {
        Inertia.post(route('posts.update', props.post.id), {
            _method: 'put',
            title: form.title,
            resume: form.resume,
            image: form.image
        });
    }
</script>
<template>
    <Head title="Editar/Post"></Head>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Post
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link
                                className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                :href="route('posts.index')">
                                Voltar
                            </Link>
                        </div>
                        <form name="createForm" @submit.prevent="submit">
                            <div className="flex flex-col">
                                <div className="mb-4">
                                        <BreezeLabel for="title" value="Título" />
                                        <BreezeInput 
                                            id="title" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            v-model="form.title" 
                                            autofocus />
                                        <span className="text-red-600" v-if="$page.props.errors.title">
                                            {{ $page.props.errors.title }}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <BreezeLabel for="resume" value="Resumo" />
                                        <BreezeInput 
                                            id="resume" 
                                            type="text"
                                            class="mt-1 block w-full" 
                                            v-model="form.resume"/>
                                        <span className="text-red-600" v-if="$page.props.errors.resume">
                                            {{ $page.props.errors.resume }}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <BreezeLabel for="image" value="Imagem (Não Obrigatorio)" />
                                        <BreezeInput
                                            id="image" 
                                            type="file"
                                            class="mt-1 block w-full" 
                                            name="image" 
                                            @input="form.image = $event.target.files[0]"/>
                                        <span className="text-red-600" v-if="$page.props.errors.image">
                                            {{ $page.props.errors.image }}
                                        </span>
                                    </div>
                                </div>
                            <div className="mt-4">
                                <button
                                    type="submit"
                                    className="px-6 py-2 font-bold text-white bg-green-500 rounded">
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>