<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<style>
#text {
    font-family: 'Lobster';
  }
  ::-webkit-scrollbar{
    display: none;
}
</style>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-blue-900 sticky top-0 z-50">
                <!-- Primary Navigation Menu -->
                <div class=" max-w-full lg:px-8">
                    <div class="flex justify-between h-20" v-if="$page.props.auth.user">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('index')">
                                    <p id="text" class="flex text-2xl text-white"><img src="../../assets/t.png" alt="logo" class="w-8 mr-2">Tik Travel</p>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <ul class="flex-col md:flex md:flex-row md:items-center" v-if="$page.props.auth.user">

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white" :href="route('alojamientos')">
                                            Alojamientos
                                        </NavLink>
                                    </div>
                                </li>

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white" :href="route('vuelos')">
                                            Vuelos
                                        </NavLink>
                                    </div>
                                </li>

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white" :href="route('publicaciones')">
                                            Publicaciones
                                        </NavLink>
                                    </div>
                                </li>

                            </ul>

                            <ul class="flex-col md:flex md:flex-row md:items-center" v-else>

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white" :href="route('alojamientos')">
                                            Alojamientos
                                        </NavLink>
                                    </div>
                                </li>

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white mr-4" :href="route('vuelos')">
                                            Vuelos
                                        </NavLink>
                                    </div>
                                </li>
                                <div class=" h-8 w-px bg-gray-300"></div>
                            </ul>
                            
                        </div>

                        <div class="hidden sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48" v-if="$page.props.auth.user">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Pefil </DropdownLink>
                                        <div v-if="$page.props.auth.user.id==2">
                                            <DropdownLink :href="route('administracion')"> Administración </DropdownLink>
                                        </div>
                                        <div v-else>
                                            <DropdownLink :href="route('reservas')"> Reservas </DropdownLink>
                                        </div>
                                        <DropdownLink :href="route('logout')" method="post" as="button"> Cerrar sesión </DropdownLink>
                                    </template>

                                </Dropdown>

                                <div align="right"  width="48" v-else>
                                    <NavLink :href="route('login')" class="text-white hover:text-white focus:text-white mr-4"> Incia sesión </NavLink>
                                    <NavLink :href="route('register')" class="text-white hover:text-white focus:text-white"> Regítrate </NavLink>
                                </div>
                            </div>

                            
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown,}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                    <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown, }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!--  -->
                    <div class="flex justify-start h-20" v-else>
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('index')">
                                    <p id="text" class="flex text-2xl text-white"><img src="../../assets/t.png" alt="logo" class="w-8 mr-2">Tik Travel</p>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <ul class="flex-col md:flex md:flex-row md:items-center" v-if="$page.props.auth.user">

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white" :href="route('alojamientos')">
                                            Alojamientos
                                        </NavLink>
                                    </div>
                                </li>

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white" :href="route('vuelos')">
                                            Vuelos
                                        </NavLink>
                                    </div>
                                </li>

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white" :href="route('publicaciones')">
                                            Publicaciones
                                        </NavLink>
                                    </div>
                                </li>

                            </ul>

                            <ul class="flex-col md:flex md:flex-row md:items-center" v-else>

                                <li>
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white" :href="route('alojamientos')">
                                            Alojamientos
                                        </NavLink>
                                    </div>
                                </li>

                                <li>
                                    <div class="hidden sm:ml-4 sm:flex">
                                        <NavLink class="text-white hover:text-white focus:text-white mr-4" :href="route('vuelos')">
                                            Vuelos
                                        </NavLink>
                                    </div>
                                </li>
                                <div class=" h-8 w-px bg-gray-300"></div>
                            </ul>
                            
                        </div>

                        <div class="hidden sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48" v-if="$page.props.auth.user">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Pefil </DropdownLink>
                                        <div v-if="$page.props.auth.user.id==2">
                                            <DropdownLink :href="route('administracion')"> Administración </DropdownLink>
                                        </div>
                                        <div v-else>
                                            <DropdownLink :href="route('reservas')"> Reservas </DropdownLink>
                                        </div>
                                        <DropdownLink :href="route('logout')" method="post" as="button"> Cerrar sesión </DropdownLink>
                                    </template>

                                </Dropdown>

                                <div align="right"  width="48" v-else>
                                    <NavLink :href="route('login')" class="text-white hover:text-white focus:text-white mr-4"> Incia sesión </NavLink>
                                    <NavLink :href="route('register')" class="text-white hover:text-white focus:text-white"> Regítrate </NavLink>
                                </div>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown,}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                    <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown, }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1" v-if="$page.props.auth.user">
                        <ResponsiveNavLink class="text-white" :href="route('alojamientos')" :active="route().current('alojamientos')">
                            Alojamientos
                        </ResponsiveNavLink>
                        <ResponsiveNavLink class="text-white" :href="route('vuelos')" :active="route().current('vuelos')">
                            Vuelos
                        </ResponsiveNavLink>
                        <ResponsiveNavLink class="text-white" :href="route('publicaciones')" :active="route().current('publicaciones')">
                            Publicaciones
                        </ResponsiveNavLink>
                    </div>

                    <div class="pt-2 pb-3 space-y-1" v-else>
                        <ResponsiveNavLink class="text-white" :href="route('alojamientos')" :active="route().current('alojamientos')">
                            Alojamientos
                        </ResponsiveNavLink>
                        <ResponsiveNavLink class="text-white" :href="route('vuelos')" :active="route().current('vuelos')">
                            Vuelos
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.auth.user">
                        <div class="px-4">
                            <div class="font-medium text-base text-white">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-white">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink class="text-white" :href="route('profile.edit')"> Perfil </ResponsiveNavLink>
                            <ResponsiveNavLink v-if="$page.props.auth.user.id==2" class="text-white" :href="route('administracion')"> Administración </ResponsiveNavLink>
                            <ResponsiveNavLink v-else class="text-white" :href="route('reservas')"> Reservas </ResponsiveNavLink>
                            <ResponsiveNavLink class="text-white" :href="route('logout')" method="post" as="button">Cerrar sesión</ResponsiveNavLink>
                        </div>
                    </div>

                    <div class="pt-4 pb-1 border-t border-gray-200" v-else>
                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink class="text-white" :href="route('login')">Inicia sesión</ResponsiveNavLink>
                            <ResponsiveNavLink class="text-white" :href="route('register')">Regístrate</ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
<section class="flex flex-col justify-between min-h-screen">
            <!-- Page Content -->
            <main>
                <slot />
            </main>
            <!-- Footer -->

                <footer class=" w-full bg-blue-900 body-font">
                    <div
                        class="container flex flex-col flex-wrap px-5 py-24 mx-auto md:items-center lg:items-start md:flex-row md:flex-no-wrap">
                        <div class="flex-shrink-0 w-64 mx-auto text-center md:mx-0 md:text-left">
                            <a class="flex items-center justify-center font-medium text-white title-font md:justify-start">
                               <p id="text" class="flex text-3xl"><img src="../../assets/t.png" alt="logo" class="w-9 mr-3">Tik Travel</p>
                            </a>
                            <div class="mt-4 ml-6">
                                <span class="inline-flex justify-center mt-2 sm:ml-auto sm:mt-0 sm:justify-start">
                                    <a class="text-gray-400 cursor-pointer hover:text-white">
                                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            class="w-5 h-5" viewBox="0 0 24 24">
                                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                        </svg>
                                    </a>
                                    <a class="ml-3 text-gray-400 cursor-pointer hover:text-white">
                                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            class="w-5 h-5" viewBox="0 0 24 24">
                                            <path
                                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a class="ml-3 text-gray-400 cursor-pointer hover:text-white">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                        </svg>
                                    </a>
                                    <a class="ml-3 text-gray-400 cursor-pointer hover:text-white">
                                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path stroke="none"
                                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                                            </path>
                                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-wrap flex-grow mt-10 -mb-10 text-center md:pl-20 md:mt-0 md:text-left">
                            <div class="w-full px-4 lg:w-1/4 md:w-1/2">
                                <h2 class="mb-3 text-sm font-extrabold tracking-widest text-white uppercase title-font">About</h2>
                                <nav class="mb-10 list-none">
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Company</a>
                                    </li>
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Careers</a>
                                    </li>
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Blog</a>
                                    </li>
                                </nav>
                            </div>
                            <div class="w-full px-4 lg:w-1/4 md:w-1/2">
                                <h2 class="mb-3 text-sm font-extrabold tracking-widest text-white uppercase title-font">Support</h2>
                                <nav class="mb-10 list-none">
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Contact Support</a>
                                    </li>
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Help Resources</a>
                                    </li>
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Release Updates</a>
                                    </li>
                                </nav>
                            </div>
                            <div class="w-full px-4 lg:w-1/4 md:w-1/2">
                                <h2 class="mb-3 text-sm font-extrabold tracking-widest text-white uppercase title-font">Platform
                                </h2>
                                <nav class="mb-10 list-none">
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Terms &amp; Privacy</a>
                                    </li>
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Pricing</a>
                                    </li>
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">FAQ</a>
                                    </li>
                                </nav>
                            </div>
                            <div class="w-full px-4 lg:w-1/4 md:w-1/2">
                                <h2 class="mb-3 text-sm font-extrabold tracking-widest text-white uppercase title-font">Contact</h2>
                                <nav class="mb-10 list-none">
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Send a Message</a>
                                    </li>
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">Request a Quote</a>
                                    </li>
                                    <li class="mt-3">
                                        <a class="text-gray-400 cursor-pointer hover:text-white">+123-456-7890</a>
                                    </li>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-300">
                        <div class="container px-5 py-4 mx-auto">
                            <p class="text-sm text-gray-700 capitalize xl:text-center">© 2023 Tik Travel</p>
                        </div>
                    </div>
                </footer>
            </section>
            </div>
        </div>
</template>
