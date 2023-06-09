<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900  scroll-smooth">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('home')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('home')" :active="route().current('home')">
                                    Home
                                </NavLink>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('discover')" :active="route().current('discover')">
                                    Discover
                                </NavLink>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('mcqcreationpage')" :active="route().current('mcqcreationpage')">
                                    Make your own
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48" v-if="$page.props.auth.user">
                                    <template #trigger >
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                            >

                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')">
                                            <div class="flex items-center justify-start">
                                                <font-awesome-icon icon="fa-solid fa-user self-center" />
                                                <div class="ml-2">
                                                    Profile
                                                </div>

                                            </div>

                                        </DropdownLink>
                                        <DropdownLink :href="route('yourmcqs')">
                                            <div class="flex items-center justify-start">
                                                <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                                                <div class="ml-2">
                                                    Your MCQs
                                                </div>
                                            </div>
                                        </DropdownLink>
                                        <DropdownLink :href="route('yourresults')">
                                            <div class="flex items-center justify-start">
                                                <font-awesome-icon icon="fa-solid fa-square-poll-vertical" />                                                <div class="ml-2">
                                                    Your Results
                                                </div>
                                            </div>
                                        </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            <div class="flex items-center justify-start text-red-500">
                                                <font-awesome-icon icon="fa-solid fa-right-from-bracket" />
                                                <div class="ml-2">
                                                    Log Out
                                                </div>
                                            </div>
                                        </DropdownLink>

                                    </template>
                                </Dropdown>
                                <template v-else>
                                    <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                        Log in
                                    </Link>

                                    <Link :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                        Register
                                    </Link>
                                </template>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 space-y-1">
                        <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
                            Home
                        </ResponsiveNavLink>
                    </div>
                    <div class="pt-1 space-y-1">
                        <ResponsiveNavLink :href="route('discover')" :active="route().current('discover')">
                            Discover
                        </ResponsiveNavLink>
                    </div>
                    <div class="pt-1 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('mcqcreationpage')" :active="route().current('mcqcreationpage')">
                            Make your own
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600" v-if="$page.props.auth.user">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                {{ $page.props.auth.user ? $page.props.auth.user.name :'Guest' }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                <div class="flex items-center justify-start">
                                    <font-awesome-icon icon="fa-solid fa-user" />
                                    <div class="ml-2">
                                        Profile
                                    </div>

                                </div>
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('yourmcqs')">
                                <div class="flex items-center justify-start">
                                    <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                                    <div class="ml-2">
                                        Your MCQs
                                    </div>

                                </div>
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('yourresults')">
                                <div class="flex items-center justify-start">
                                    <font-awesome-icon icon="fa-solid fa-square-poll-vertical" />
                                    <div class="ml-2">
                                        Your Results
                                    </div>

                                </div>
                            </ResponsiveNavLink>

                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                <div class="flex items-center justify-start">
                                    <font-awesome-icon icon="fa-solid fa-right-from-bracket" />
                                    <div class="ml-2">
                                        Log Out
                                    </div>

                                </div>
                            </ResponsiveNavLink>
                        </div>
                    </div>
                    <div v-else>
                        <div class="space-y-1">
                            <ResponsiveNavLink :href="route('login')">
                                Log in
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('register')">
                                Register
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>


            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
            <footer class="bg-white shadow dark:bg-gray-800">
                <div class="w-full mx-auto container md:p-6 p-4 md:flex md:items-center md:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                        © 2023
                        <a href="" class="hover:underline">
                            MOSSS™
                        </a>. All Rights Reserved.
                    </span>
                    <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Contact</a>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
</template>
