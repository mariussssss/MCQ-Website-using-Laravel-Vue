<template>
    <div class="grid  sm:grid-cols-1 md:grid-cols-2 gap-4 ">
        <Link v-for="subject in $page.props.subjects" :href="route('mcqpage', subject.id)" class="shadow bg-gradient-to-br hover:bg-gradient-to-bl focus:ring-4 focus:outline-none rounded-lg text-2xl px-5 py-10 text-center mr-2 mb-2 font-medium" :class="[classButtons[subject.color-1]]">
            {{ subject.name }}
        </Link>
        <Link :href="route('mcqcreationpage')" class="bg-gradient-to-br hover:bg-gradient-to-bl focus:ring-4 focus:outline-none rounded-lg text-2xl px-5 py-10 text-center mr-2 mb-2 font-medium" :class="[classButtons[6-1]]">
            Make your own
        </Link>
    </div>
</template>

<script>

import { Link } from '@inertiajs/vue3';

export default{

    data(){
        const classButtons = [
            "text-white from-purple-600 to-blue-500 focus:ring-blue-300 dark:focus:ring-blue-800",
            "text-white from-cyan-500 to-blue-500 focus:ring-cyan-300 dark:focus:ring-cyan-800 ",
            "text-white from-green-400 to-blue-600 focus:ring-green-200 dark:focus:ring-green-800 ",
            "text-white from-purple-500 to-pink-500 focus:ring-purple-200 dark:focus:ring-purple-800",
            "text-white from-pink-500 to-orange-400 focus:ring-pink-200 dark:focus:ring-pink-800",
            "text-gray-900 from-teal-200 to-lime-200 hover:from-teal-200 hover:to-lime-200 focus:ring-lime-200 dark:focus:ring-teal-700",
            "text-gray-900 from-red-200 via-red-300 to-yellow-200 focus:ring-red-100 dark:focus:ring-red-400"
        ];
        return {
            classButtons
        }
    },
    
    components: {
        Link
    },

}
</script>