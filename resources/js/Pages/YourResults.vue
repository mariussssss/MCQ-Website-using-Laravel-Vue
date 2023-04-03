<template>
    <Head title="Your Results" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Your Results</h2>
        </template>



        <div class="grid grid-cols-1  md:grid-cols-2 gap-4 sm:px-6 px-4 lg:px-8 mt-6 text-white pb-10 ">
            <div class="bg-gradient-to-r text-white from-purple-600 to-blue-500 rounded-lg p-1 text-center self-start">
                <div class="text-xl p-2 font-medium">
                    Last 5 Results
                </div>
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-lg">
                    <div class="relative overflow-x-auto rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400  ">

                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
                                <tr>
                                    <th scope="col" class="px-2 pl-6  py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        ID of MCQ
                                    </th>

                                    <th scope="col" class="px-2 py-3">
                                        Author
                                    </th>
                                    <th scope="col" class="py-3 pr-1">
                                        Score
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col" class="px-2 pl-6  py-3">
                                        mmamade la mama
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        12
                                    </th>

                                    <th scope="col" class="px-2 py-3">
                                        MArius
                                    </th>
                                    <th scope="col" class="py-3 pr-1">
                                        4/5
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-2 pl-6  py-3">
                                        mmamade la mama
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        12
                                    </th>

                                    <th scope="col" class="px-2 py-3">
                                        MArius
                                    </th>
                                    <th scope="col" class="py-3 pr-1">
                                        4/5
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-2 pl-6  py-3">
                                        mmamade la mama
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        12
                                    </th>

                                    <th scope="col" class="px-2 py-3">
                                        MArius
                                    </th>
                                    <th scope="col" class="py-3 pr-1">
                                        4/5
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-2 pl-6  py-3">
                                        mmamade la mama
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        12
                                    </th>

                                    <th scope="col" class="px-2 py-3">
                                        MArius
                                    </th>
                                    <th scope="col" class="py-3 pr-1">
                                        4/5
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-2 pl-6  py-3">
                                        mmamade la mama
                                    </th>
                                    <th scope="col" class="px-2 py-3">
                                        12
                                    </th>

                                    <th scope="col" class="px-2 py-3">
                                        MArius
                                    </th>
                                    <th scope="col" class="py-3 pr-1">
                                        4/5
                                    </th>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gradient-to-r text-white from-purple-600 to-blue-500 rounded-lg p-1 text-center  self-start" >
                    <div class="text-xl p-2 font-medium">
                        Average Score
                    </div>
                    <div class="bg-gray-900 rounded-lg p-3 text-white ">
                        <div class="text-4xl font-semibold">
                            83%<!-- ({{ parseInt(userScore.no_correct_answers * 100 / userScore.no_questions) }}%) -->
                            <div class="flex items-center mt-4">

                                <div class=" w-full h-5  bg-gray-200 rounded dark:bg-gray-600">
                                    <div class="h-5 bg-green-400 rounded" :style="'width:' + 83 + '%'"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-r text-white from-purple-600 to-blue-500 rounded-lg p-1 text-center self-start" >
                    <div class="text-xl p-2 font-medium">
                        Number of MCQ played
                    </div>
                    <div class="bg-gray-900 rounded-lg p-3 text-white ">
                        <div class="text-4xl font-semibold">
                            34<!-- ({{ parseInt(userScore.no_correct_answers * 100 / userScore.no_questions) }}%) -->
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-r text-white from-purple-600 to-blue-500 rounded-lg p-1 text-center  self-start" >
                    <div class="text-xl p-2 font-medium">
                        Average Difficulty Rating
                    </div>
                    <div class="bg-gray-900 rounded-lg p-3 text-white ">
                        <div class="text-4xl font-semibold">
                            4.7/5<!-- ({{ parseInt(userScore.no_correct_answers * 100 / userScore.no_questions) }}%) -->
                        </div>
                        <p class="text-xl text-gray-600 mt-2 ">
                            <font-awesome-icon v-for="i in 5" :class="{ 'text-yellow-500' : i <= 4}" icon="fa-solid fa-star " />
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>

import { Head, usePage, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout, Head, FontAwesomeIcon, Link
    },
}

</script>
