<script setup>

</script>

<template>
    <Head :title="subjectName" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div v-if="userRate" class="text-white px-12 pb-6">
                You have rated this MCQ : {{ userRate }} out of 5
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div :class="bgClasses[subjectColor-1].class" class="p-6 mb-5 text-4xl font-medium text-gray-900 dark:text-white bg-gradient-to-br">
                        {{ subjectName }}
                    </div>
                    <div v-for="(data,key) in questionsAndAnswers" class="p-6 pt-0 text-gray-900 dark:text-gray-100">
                        <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">
                            {{ key }}
                        </h3>
                        <ul class="grid w-full gap-2 md:grid-cols-1">
                            <li v-for="answer in data">
                                <input type="checkbox"  :disabled="clicked" class="hidden peer" :id="answer.id" v-model="answer.is_checked" >
                                <label :for="answer.id"  :class="clicked ? (answer.is_correct ? greenBorder : answer.is_checked ? redBorder : '') : blueBorder" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" >                           
                                    <div class="block">
                                        <div class="w-full font-semibold">{{ answer.text }}</div>
                                    </div>
                                    <div class="">
                                        <font-awesome-icon v-if="clicked && answer.is_correct" class="text-green-600" icon="fa-solid fa-check" />
                                        <font-awesome-icon v-if="clicked && answer.is_checked && !answer.is_correct"  class="text-red-600" icon="fa-solid fa-xmark" />
                                    </div>
                                </label> 
                            </li>
                        </ul>
                    </div>
                    <div class="px-4 py-3 flex justify-between sm:px-6">
                        <Link :href="route('score.store')" method="post" as="button" preserve-scroll type="submit" @click="submitAnswer" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <div class="py-0 px-5 text-lg">
                                Submit
                            </div>
                        </Link>
                        <p v-if="clicked" class="px-9 py-3 text-2xl text-white "> You have reached {{ numberOfGoodAnswer }} of {{ size }} points, ({{ parseInt(numberOfGoodAnswer * 100 / size) }}%)</p> 
                        <Link v-if="clicked" href="">
                            <button class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-2 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                <div class="py-0 px-5 text-lg">
                                    Retry
                                </div>
                            </button>
                        </Link>
                    </div>  
                </div>
            </div>
            <div v-if="!userRate && clicked" class="px-6 pt-6">
                <div class="flex flex-wrap justify-center items-center mt-2">
                    <div class="text-white">
                        <p class="text-xl text-medium">
                            How difficult was this MCQ ?
                        </p> 
                        <p class="text-sm text-gray-300">
                            
                            <font-awesome-icon v-for="i in 5" class="text-xs text-gray-600" :class="i == 1 ? 'text-yellow-500' : ''" icon="fa-solid fa-star" />
                            = Very easy, 
                        </p>
                        <p class="text-sm text-gray-300">

                            <font-awesome-icon v-for="i in 5" class="text-xs text-yellow-500" icon="fa-solid fa-star" />
                            = Very difficult 
                        </p>
                            
                        
                    </div>
                    <div class="flex flex-row-reverse justify-end ml-4 pt-2">
                        <div v-for="i in 5" @click="chooseGrade(i)" class="cursor-pointer text-3xl text-gray-600 peer peer-hover:text-yellow-500 hover:text-yellow-500 " :class="i>=selectedStar ? ' text-yellow-500' : ''">
                            <font-awesome-icon icon="fa-solid fa-star" />
                        </div>
                        
                    </div>
                    
                    <form @submit.prevent="form.post(route('grade.store'))">
                        <button type="submit" :disabled="form.processing || form.grade > 5 " class="ml-5 mt-5 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Send
                        </button>
                    </form>
                </div>  
            </div>
            
        </div>
    </AuthenticatedLayout>
    
</template>


<script>
import { computed } from 'vue'
import { Head, usePage, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout, Head, FontAwesomeIcon, Link
    },
    setup(){
        const form = useForm ({
            grade : 10,
            subjectId : computed(() => usePage().props.subjectId)
        });

        return { form }
    },
    data() {
        const bgClasses = [
            {"class" : "from-purple-600 to-blue-500"},
            {"class" : "from-cyan-500 to-blue-500"},
            {"class" : "from-green-400 to-blue-600"},
            {"class" : "from-purple-500 to-pink-500"},
            {"class" : "from-pink-500 to-orange-400 "},
            {"class" : "from-teal-200 to-lime-200"},
            {"class" : "from-red-200 via-red-300 to-yellow-200"}
        ];
        const questionsAndAnswers = computed(() => usePage().props.questionsAndAnswers)
        const subjectName = computed(() => usePage().props.subjectName)
        const subjectColor = computed(() => usePage().props.subjectColor)
        const userRate = computed(() => usePage().props.userRate)
        const blueBorder = "peer-checked:border-blue-600"
        const greenBorder = "dark:border-green-600"
        const redBorder = "dark:border-red-600"
        const clicked = false;
        const selectedStar = 10;
        return {
            questionsAndAnswers,
            subjectName,
            subjectColor,
            userRate,
            bgClasses,
            numberOfGoodAnswer : "",
            size : "",
            blueBorder,
            greenBorder,
            redBorder,
            clicked,
            selectedStar
        }
        
    },
    methods: {
        allAnswerGood() {
            let correctAnswers = 0;
            const numberOfQuestion = Object.keys(this.questionsAndAnswers).length
            for (let index = 0; index < numberOfQuestion; index++) {
                const answers = this.questionsAndAnswers[Object.keys(this.questionsAndAnswers)[index]];
                correctAnswers += 1;
                for (let index2 = 0; index2 < Object.keys(answers).length; index2++) {
                    if (answers[index2].is_checked != answers[index2].is_correct){
                        correctAnswers -= 1;
                        break;
                    }
                }
            }
            return {"numberOfCorrectAnswer" : correctAnswers, "numberOfQuestion" : numberOfQuestion};
        },
        submitAnswer(event) {
            this.numberOfGoodAnswer = this.allAnswerGood()["numberOfCorrectAnswer"];
            this.size = this.allAnswerGood()["numberOfQuestion"];
            this.clicked = true;
        },
        chooseGrade(index){
            this.selectedStar = index;
            this.form.grade = 6-index;
        }
    }


}
</script>