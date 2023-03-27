<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="place-content-center py-12 2xl:py-20">
                <div class="text-center text-gray-500 text-3xl opacity-30">
                    <font-awesome-icon icon="fa-solid fa-lock" />
                </div>
                
                <div class="text-2xl font-medium text-white text-center px-10 mt-2">
                    Log in and <a class="underline decoration-sky-500">discover</a> tons of MCQs or even <a class="underline decoration-sky-500">create your own</a> ! 
                </div>
                <div class="text-gray-400 text-center px-10 mt-2">
                    By logging in you will be able to find your friends' MCQs, to rate their difficulty or even to see again your past MCQ and try to improve yourself ! <br>
                    You will also be able to see the average result for every MCQs after finished it. 
                </div>

                <div class="text-center mt-4">
                    <Link :href="route('login')" type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-xl px-8 py-4 text-center mr-2 mb-2">
                        Log In
                    </Link>
                </div>                        
            </div>
        </div>
    </div>
</template>