<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NotLogDiscover from '@/Layouts/NotLogDiscover.vue';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Discover" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Discover</h2>
        </template>
        <div v-if="subjects">
            <div class="py-12">
                <div class="px-4 sm:px-8 lg:px-10 text-lg font-semibold text-left text-gray-900 dark:text-white">
                    <div class="m-0 p-0">
                        MCQ gallery
                    </div>

                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Have fun trying to solve the MCQs on the topics you like, or look for your friends' MCQs!</p>
                    <div class="mt-3">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="flex flex-wrap gap-x-3 gap-y-2 mb-4">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input type="text" @click="searchById = ''" v-model="searchByName" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search MCQ by name">
                            </div>
                            <div class="font-normal mt-1">
                                or
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input type="text" @click="searchByName = ''" v-model="searchById" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search MCQ by ID">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="relative overflow-x-auto sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400  ">

                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                                    <tr>
                                        <th scope="col" class="px-2 pl-6  py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-2 py-3">
                                            ID of MCQ
                                        </th>
                                        <th scope="col" class="px-2 py-3">
                                            Difficulty Rating
                                        </th>
                                        <th scope="col" class="px-2 py-3">
                                            Author
                                        </th>
                                        <th scope="col" class="py-3 pr-1">
                                            Play
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(subject,key) in subjects.data" :class="key+1 == subjects.data.length ? '' : ' border-b '" class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-2 pl-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ subject.name }}
                                        </th>
                                        <td class="px-2 py-4">
                                            {{ subject.id }}
                                        </td>
                                        <td class="px-2 py-4">
                                            <p v-if="subject.rate" class="agent-note text-yellow-600">
                                                <font-awesome-icon v-for="i in Math.floor(subject.rate)" icon="fa-solid fa-star" />
                                                <font-awesome-icon v-if="subject.rate - Math.floor(subject.rate) > 0" icon="fa-regular fa-star-half-stroke" />
                                                <font-awesome-icon v-for="i in Math.floor(5-subject.rate)" icon="fa-regular fa-star" />
                                            </p>
                                            <p v-else>
                                                Unrated
                                            </p>
                                        </td>
                                        <td class="px-2 py-4">
                                            {{ subject.user_name }}
                                        </td>
                                        <td class="py-1 pr-1">
                                            <Link :href="route('mcqpage', subject.id)" type="button" class="shadow bg-gradient-to-br hover:bg-gradient-to-bl focus:ring-4 focus:outline-none rounded-lg text-base px-4 py-1.5 text-center" :class="[classButtons[subject.color-1]]">
                                                Play
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div v-if="subjects.total != 0 " class="flex flex-col items-center mt-2">
                        <!-- Help text -->
                        <span  class="text-sm text-gray-700 dark:text-gray-400">
                            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ subjects.from }}</span> to <span class="font-semibold text-gray-900 dark:text-white">{{ subjects.to }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ subjects.total }}</span> MCQs
                        </span>
                        <!-- Buttons -->
                        <div class="inline-flex mt-2 xs:mt-0">
                            <Component :is="subjects.prev_page_url ? 'Link' : 'span'" :href="subjects.prev_page_url" preserve-scroll class=" px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ">
                                Prev
                            </Component>
                            <Component :is="subjects.next_page_url ? 'Link' : 'span'" :href="subjects.next_page_url" preserve-scroll class="px-4 py-2 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                Next
                            </Component>
                        </div>
                    </div>
                    <div v-else class="text-gray-700 dark:text-gray-400 flex flex-col  items-center mt-10 mb-44">
                        <div class="text-lg text-white font-medium">
                            No results were found
                        </div>
                        <div>
                            Make sure you have enter the correct ID or Name
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <NotLogDiscover></NotLogDiscover>
        </div>
    </AuthenticatedLayout>
</template>

<script>

import { Link, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

export default{
    props:{
        filters : Object,
        subjects : Object
    },

    data(){
        const classButtons = [
            "text-white from-purple-600 to-blue-500 focus:ring-blue-300 dark:focus:ring-blue-800",
            "text-white from-cyan-500 to-blue-500 focus:ring-cyan-300 dark:focus:ring-cyan-800 ",
            "text-white from-green-400 to-blue-600 focus:ring-green-200 dark:focus:ring-green-800 ",
            "text-white from-purple-500 to-pink-500 focus:ring-purple-200 dark:focus:ring-purple-800",
            "text-white from-pink-500 to-orange-400 focus:ring-pink-200 dark:focus:ring-pink-800",
            "text-gray-900 from-teal-200 to-lime-200 hover:from-teal-200 hover:to-lime-200 focus:ring-lime-200 dark:focus:ring-teal-700",
            "text-gray-900 from-red-200 via-red-300 to-yellow-200 focus:ring-red-100 dark:focus:ring-red-400",
            "text-white from-black to-indigo-900 hover:from-indigo-900 hover:to-black "
        ];
        const moyenne_note2 = 3;
        const verif = 1;
        let searchByName = ref('');
        let searchById = ref('');
        if (this.filters) {
            searchByName = ref(this.filters.searchByName);
            //
            searchById = ref(this.filters.searchById);
        }
        watch(searchByName, value => {
            this.$inertia.get('/discover', {searchByName : value}, {
                preserveState : true,
                replace: true
            });

        });

        watch(searchById, value => {
            this.$inertia.get('/discover', {searchById : value}, {
                preserveState : true,
                replace: true
            });
        });

        return {
            classButtons,
            moyenne_note2,
            verif,
            searchByName,
            searchById
        }
    },
    components: {
        Link
    },

}
</script>
