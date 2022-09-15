<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeInput from '@/Components/Input.vue';

    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    const props = defineProps({
        categories: Array
    });
    const form = useForm({
        title: '',
        description: '',
        image: '',
        category_id: ''
    })
    const submit = () => {
        form.post(route('notices.store'), {
            forceFormData: true
        });
    };
</script>
<template>
    <Head title="Criar/Notícias"></Head>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Notícia
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link
                                className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                :href="route('notices.index')">
                                Voltar
                            </Link>
                        </div>
                        <form name="createForm" @submit.prevent="submit">
                            <div className="flex flex-col">
                                <div className="mb-4">
                                    <BreezeLabel for="category" value="Categoria"/>
                                    <select name="category_id" v-model="form.category_id" id="category" class="mt-1 block">
                                        <option value="" disabled selected >Selecione a Categoria</option>
                                        <option v-for="category in categories" :key="category.id" 
                                        :value="category.id">
                                        {{category.title}}
                                        </option>
                                    </select>
                                    <span className="text-red-600" v-if="form.errors.category_id">
                                        {{ form.errors.category_id }}
                                    </span>
                                </div>
                                <div className="mb-4">
                                    <BreezeLabel for="title" value="Título" />
                                    <BreezeInput 
                                        id="title" 
                                        type="text" 
                                        class="mt-1 block w-full" 
                                        v-model="form.title" 
                                        />
                                    <span className="text-red-600" v-if="form.errors.title">
                                        {{ form.errors.title }}
                                    </span>
                                </div>
                                <div className="mb-4">
                                    <BreezeLabel for="description" value="Descrição"/>
                                    <textarea v-model="form.description" id="description" cols="30" rows="10" class="mt-1 block w-full">
                                    </textarea>
                                    <span className="text-red-600" v-if="form.errors.description">
                                        {{ form.errors.description }}
                                    </span>
                                </div>
                                <div className="mb-4">
                                    <BreezeLabel for="image" value="Imagem" />
                                    <BreezeInput
                                        id="image" 
                                        type="file"
                                        class="mt-1 block w-full" 
                                        name="image" 
                                        @input="form.image = $event.target.files[0]"
                                        />
                                    <span className="text-red-600" v-if="form.errors.image">
                                        {{ form.errors.image }}
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