<template>
    <Head title="Your MCQs" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Your MCQs</h2>
        </template>
        Your mcqs
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
