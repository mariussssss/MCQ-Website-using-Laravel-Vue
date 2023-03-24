<template>
    <Head title="Make your own" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <form @submit.prevent="form.post(route('mcqcreationpage.store'))">
                        <label class="ml-4 block font-medium text-gray-900 dark:text-white">Title : </label>
                        <input v-model="form.name" type="text" class="ml-4 mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your title ...">
                        <div v-if="errors.name" class="text-red-600">
                            {{ errors.name }}
                        </div> 
                        <label class="ml-4 mt-6 block font-medium text-gray-900 dark:text-white">Theme color : </label>
                        <div class="ml-4 mt-2 flex justify-start">
                            <button type="button" v-for="(color, index) in classButtons" @click=" form.color = index + 1" :class=" form.color === index + 1? 'border-solid border-black outline outline-2 outline-yellow-400 border-2 ' + color.class : color.class" class="cursor-pointer w-20 h-20 bg-gradient-to-br hover:bg-gradient-to-tl rounded-lg mr-4 mb-2" >
                            </button>
                        </div>
                        <div v-if="errors.color" class="text-red-600">
                            {{ errors.color }}
                        </div>                       
                        <div class="mt-6" >
                            <div v-for="(question,index) in form.questionTab" class=" p-6 pt-3 mb-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="mb-6">
                                    <div class="flex justify-between">
                                        <label class="h-8 mt-4 block mb-2 font-medium text-gray-900 dark:text-white">Question n°{{ index+1 }}</label>
                                        <button type="button" @click="form.questionTab.splice(index, 1);" class="text-red-500 text-lg mr-2 mb-4">
                                            <font-awesome-icon v-if="index!=0" icon="fa-solid fa-trash-can" />
                                        </button>
                                    </div>
                                    <input v-model="question.text" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your question ...">
                                </div>
                                <div class="mb-6">
                                    <div class="flex items-center mb-2">
                                        <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">Answers for Question n°{{ index+1 }} (please check the correct answer)</label>
                                        <button type="button" :disabled="question.numberOfAnswer>=4" @click="question.numberOfAnswer++" class="ml-4 text-green-500 text-lg disabled:opacity-60" >
                                            <font-awesome-icon icon="fa-solid fa-plus" />
                                        </button>
                                        <button type="button" :disabled="question.numberOfAnswer<=2" @click="question.numberOfAnswer--" class="ml-4 text-red-500 text-lg  disabled:opacity-60" >
                                            <font-awesome-icon icon="fa-solid fa-minus" />
                                        </button>                 
                                    </div>
                                    <div v-for="i in question.numberOfAnswer" class="flex items-center mb-2">
                                        <input type="text" v-model="question.answers[i-1]" class=" h-8 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                        <input type="checkbox" value="" class="ml-2 w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div class="pl-6 flex items-center mb-4">
                                    <div class="w-36">
                                        <label class="block font-medium text-gray-900 dark:text-white">Add a question :</label>
                                        <label class="block font-medium text-gray-900 dark:text-gray-500 text-xs">(you can have up to 20 questions in total)</label>
                                    </div>
                                    <input type="text" id="questInput" v-model="numberOfQuestion" :class="classForTooMuchQuest" class="ml-0 sm:text-xs w-10 h-8 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <button @click="addQuestions" :disabled="form.questionTab.length >= 20" type="button" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</button>
                                </div>
                                <button type="submit" :disabled="form.processing" class=" text-white from-purple-600 to-blue-500 focus:ring-blue-300 dark:focus:ring-blue-800 bg-gradient-to-br hover:bg-gradient-to-bl focus:ring-4 focus:outline-none rounded-lg px-5 py-2.5 w-32 text-center  mb-2 font-medium">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div v-if="errors['questionTab.0.text']" class="text-red-600">
                        {{ errors['questionTab.0.text'] }}
                    </div> 
                    <div v-if="errors['questionTab.0.answers.0']" class="text-red-600">
                        {{ errors['questionTab.0.answers.0'] }}
                    </div> 
                    <div v-if="errors['questionTab.0.answers.1']" class="text-red-600">
                        {{ errors['questionTab.0.answers.1'] }}
                    </div> 
                    <div v-if="errors['questionTab.0.answers.2']" class="text-red-600">
                        {{ errors['questionTab.0.answers.2'] }}
                    </div> 
                    <div v-if="errors['questionTab.0.answers.3']" class="text-red-600">
                        {{ errors['questionTab.0.answers.3'] }}
                    </div> 
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>


import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout, Head, FontAwesomeIcon
    },
    setup(){
        const form = useForm ({
            name : '',
            color : '',
            questionTab : [{
                text : "",
                numberOfAnswer : 4, 
                answers : ["", "", "", ""],
                /* {text : "", isCorrect : false},
                    {text : "", isCorrect : false},
                    {text : "", isCorrect : false},
                    {text : "", isCorrect : false}, */
            }]
        });

        return { form }
    },
    props: {
        errors: Object
    },
    data() {
        const classButtons = [
            {"class" : "from-purple-600 to-blue-500"},
            {"class" : "from-cyan-500 to-blue-500"},
            {"class" : "from-green-400 to-blue-600"},
            {"class" : "from-purple-500 to-pink-500"},
            {"class" : "from-pink-500 to-orange-400 "},
            {"class" : "from-teal-200 to-lime-200"},
            {"class" : "from-red-200 via-red-300 to-yellow-200"}
        ];
        let numberOfAnswer = 2;
        let numberOfQuestion = 1;
        let classForTooMuchQuest = "";
        return {
            numberOfAnswer,
            numberOfQuestion,
            classButtons,
            classForTooMuchQuest
        }
    },
    methods: {
        addQuestions() {
            if (this.numberOfQuestion > 20 - this.form.questionTab.length){
                this.numberOfQuestion = 20 - this.form.questionTab.length;
            }
            else {
                for(let i = 0; i < this.numberOfQuestion; i++){
                    this.form.questionTab.push({"text" : "","numberOfAnswer" : 4, "answers" : ["", "", "", ""]})
                }
                this.numberOfQuestion = 1;
            }
        },
    }
}
</script>