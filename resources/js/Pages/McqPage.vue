<script setup>

</script>

<template>
    <Head :title="subjectName ? subjectName : 'MCQ not found'" />
    <AuthenticatedLayout>
        <div v-if="subjectName" class="py-12" >
            <div  class="  sm:mx-12  overflow-hidden ">
                <div :class="bgClasses[subjectColor-1].class" class=" sm:rounded-lg bg-gradient-to-r p-6 text-4xl font-bold  ">
                    {{ subjectName }}
                </div>
                <div v-if="userScore"  class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 font-medium"> <!-- grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 -->
                    <div :class="bgClasses[subjectColor-1].class" class="bg-gradient-to-r rounded-lg p-1 text-center mx-4 sm:mx-0 self-start" >
                        <div class="text-xl p-2">
                            Your score
                        </div>
                        <div class="bg-gray-900 rounded-lg p-3 text-white ">
                            <div class="text-4xl font-semibold">
                                {{ userScore.no_correct_answers }}/{{ userScore.no_questions }}<!-- ({{ parseInt(userScore.no_correct_answers * 100 / userScore.no_questions) }}%) -->
                                <div class="flex items-center mt-4">

                                    <div class=" w-full h-5 mr-4 bg-gray-200 rounded dark:bg-gray-600">
                                        <div class="h-5 bg-green-400 rounded" :class="{ 'bg-gradient-to-r from-green-500 to-green-600' : subjectColor==3}" :style="'width:' + parseInt(userScore.no_correct_answers * 100 / userScore.no_questions) + '%'"></div>
                                    </div>
                                    <span class="text-sm">{{ parseInt(userScore.no_correct_answers * 100 / userScore.no_questions) }}%</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div :class="bgClasses[subjectColor-1].class" class="bg-gradient-to-r rounded-lg p-1 text-center mx-4 sm:mx-0 self-start" >
                        <div class="text-xl p-2">
                            Your difficulty rating
                        </div>
                        <div class="bg-gray-900 rounded-lg p-3 text-white">

                            <div v-if="userRate" class="text-xl">
                                <div class="text-4xl  font-semibold">
                                    {{ userRate }}/5
                                </div>

                                <p class="text-xl text-gray-600 mt-2 ">
                                    <font-awesome-icon v-for="i in 5" :class="{ 'text-yellow-500' : i <= userRate && subjectColor != 7, 'text-red-500' : i <= userRate && subjectColor == 7}" icon="fa-solid fa-star " />
                                </p>
                            </div>
                            <div v-else>

                                <div class="text-lg font-medium">
                                    Don't forget to rate the difficulty !
                                </div>
                                <button :class="bgClasses[subjectColor-1].class"   type="button" @click="goToDiffRateForm" class="m-1 text-lg  bg-gradient-to-r hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg px-5 py-2 text-center">
                                    Rate now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="px-4 mt-10">

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="  shadow-sm sm:rounded-lg">
                        <div v-for="(data,key, index) in questionsAndAnswers" class="p-6 pt-0 text-gray-900 dark:text-gray-100">
                            <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">
                                {{index+1}}) {{ key }}
                            </h3>
                            <ul class="grid w-full gap-2 md:grid-cols-1">
                                <li v-for="answer in data" class="px-4">
                                    <input type="checkbox"  :disabled="userScore" class="hidden peer" :id="answer.id" v-model="answer.is_checked" >
                                    <label :for="answer.id"  :class="userScore ? (answer.is_correct ? greenBorder : answer.is_checked ? redBorder : '') : blueBorder" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-0 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gradient-to-br from-gray-800 to-gray-700 dark:hover:to-gray-800" >
                                        <div class="block">
                                            <div class="w-full font-semibold">{{ answer.text }}</div>
                                        </div>
                                        <div class="">
                                            <font-awesome-icon v-if="userScore && answer.is_correct" class="text-green-600" icon="fa-solid fa-check" />
                                            <font-awesome-icon v-if="userScore && answer.is_checked && !answer.is_correct"  class="text-red-600" icon="fa-solid fa-xmark" />
                                        </div>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="px-6 py-3 flex justify-center sm:px-6">
                            <form @submit.prevent="submitAnswer" >
                                <button  type="submit" preserve-scroll :disabled="userScore" :class="{'dark:bg-green-700' : userScore}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    <div class="py-0 px-5 text-lg">
                                        Submit
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="diffRate" v-if="!userRate && userScore" class="px-6 pt-6">
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
        </div>
        <div v-else="" class="py-12 h-screen flex justify-center text-gray-500" >
            <div class="self-center text-center ">
                ERROR : MCQ NOT FOUND
            </div>

        </div>
    </AuthenticatedLayout>

</template>


<script>
import { computed } from 'vue'
import { Head, usePage, useForm, useRemember } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout, Head, FontAwesomeIcon, Link
    },
    props: {
        subjectId : String,
        subjectName : String,
        subjectColor : Number,
        userRate : Number,
        userScore : Object
    },
    setup(){
        const form = useForm ({
            grade : 10,
            subjectId : computed(() => usePage().props.subjectId)
        });

        let questionsAndAnswers = usePage().props.questionsAndAnswers

        const scoreForm = useForm ({
            /* subjectId : computed(() => usePage().props.subjectId),
            subjectName : computed(() => usePage().props.subjectName),
            questionsAndAnswers : computed(() => usePage().props.questionsAndAnswers),
            subjectColor : computed(() => usePage().props.subjectColor),
            userRate : computed(() => usePage().props.userRate), */

            subject_id : computed(() => usePage().props.subjectId),
            user_id : computed(() => usePage().props.auth.user.id),
            no_questions : Object.keys(usePage().props.questionsAndAnswers).length,
            no_correct_answers : 0
        });

        return { form, scoreForm, questionsAndAnswers }
    },
    data() {
        const bgClasses = [
            {"class" : "text-white from-purple-600 to-blue-500"},
            {"class" : "text-white from-cyan-500 to-blue-500"},
            {"class" : "text-white from-green-400 to-blue-600"},
            {"class" : "text-white from-purple-500 to-pink-500"},
            {"class" : "text-white from-pink-500 to-orange-400 "},
            {"class" : "text-gray-900 from-teal-200 to-lime-200"},
            {"class" : "text-gray-900 from-red-200 via-red-300 to-yellow-200"}
        ];
        const blueBorder = "peer-checked:border-blue-600 peer-checked:border-2"
        const greenBorder = "dark:border-green-600 dark:border-2"
        const redBorder = "dark:border-red-600 dark:border-2"
        const clicked = false;
        const selectedStar = 10;



        return {
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
            this.scoreForm.no_correct_answers = this.numberOfGoodAnswer;
            this.scoreForm.post(route('score.store'))
        },
        chooseGrade(index){
            this.selectedStar = index;
            this.form.grade = 6-index;
        },
        goToDiffRateForm(){
            var diffRateForm = document.getElementById("diffRate");

            diffRateForm.scrollIntoView({
            behavior: "smooth",
            block: "start",
            inline: "nearest"
            });
        }
    }


}
</script>
