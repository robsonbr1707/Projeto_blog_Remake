<script setup>
    
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import BreezeInput from '@/Components/Input.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    search: ''
});


function submit()
{
    form.post(route('search'), {
        preserveState: true,
    });
}

const showingNavigationDropdown = ref(false);

</script>

<template>

    <!-----------Header-------------->
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-gray-300 border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('welcome')">
                                <BreezeApplicationLogo class="block h-9 w-auto" />
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" v-if="$page.props.auth.user && $page.props.auth.user.role_id == 2">
                            <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-lg text-gray-800 font-bold">
                                Área do Admin
                            </BreezeNavLink>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <BreezeNavLink :href="route('site.notice.index')" :active="route().current('dashboard')" class="text-lg text-gray-800 font-bold">
                                Notícias
                            </BreezeNavLink>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <BreezeNavLink :href="route('site.post.index')" :active="route().current('dashboard')" class="text-lg text-gray-800 font-bold">
                                Publicações
                            </BreezeNavLink>
                        </div>
                        
                    </div>
                    <div v-if="!$page.props.auth.user" class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <BreezeNavLink :href="route('login')" :active="route().current('login')" class="text-base text-gray-800 font-semibold">
                            Entrar
                        </BreezeNavLink>
                        <BreezeNavLink :href="route('register')" :active="route().current('register')" class="text-base text-gray-800 font-semibold">
                            Cadastrar
                        </BreezeNavLink>
                    </div>
                    
                    <div v-else class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <BreezeDropdown align="right" width="48" >
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            {{ $page.props.auth.user.name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>
                                
                                <template #content>
                                    <div>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Sair da Conta
                                        </BreezeDropdownLink>
                                    </div>
                                </template>
                            </BreezeDropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <BreezeResponsiveNavLink :href="route('welcome')" :active="route().current('welcome')">
                        Inicio
                    </BreezeResponsiveNavLink>
                    <BreezeResponsiveNavLink :href="route('site.post.index')" :active="route().current('site.post.*')">
                        Publicações
                    </BreezeResponsiveNavLink>
                    <BreezeResponsiveNavLink :href="route('site.notice.index')" :active="route().current('site.notice.*')">
                        Notícias
                    </BreezeResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.auth.user">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </BreezeResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-gray-200 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex">
                
                <form class="ml-4 flex w-full md:w-1/3" @submit.prevent="submit">
                    <BreezeInput type="text" v-model="form.search" name="search" class="w-full" placeholder="Pesquise por algo" />
                    <button class="ml-2 bg-white p-2 border border-gray-300 rounded-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>

        <!-- Rodape -->
        <footer class="text-center p-2 mt-5 text-white bg-gray-500">
            
            <div class="text-center p-4">
                &copy; Robson Luiz 2022
                <a class="text-white" href="https://tailwind-elements.com/"></a>
            </div>
        </footer>
    </div>
</template>