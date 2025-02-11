setup
<script setup>
import {ref, onMounted} from 'vue';
import { useRoute } from 'vue-router';
import { useRouter } from "vue-router";

const router = useRouter();

const route = useRoute();

const books = ref([])


onMounted(async () => {
    try {
        let response = await axios.get("/api/user");
        response = await axios.get("/api/books");
        books.value = response.data.data;
    } catch (error) {
        router.push("/login");
    }
})

</script>

<template>
    <h2>Books</h2>



    <ul>
        <li v-for="book in books" :key="book.id">
            <span>{{ book.title }}</span>
            <span>{{ book.author }}</span>
            <span>{{ book.release_year }}</span>
            <RouterLink :to="`/book/${book.id}`">
                Check
            </RouterLink>
        </li>
    </ul>
</template>


<style scoped>
    li {
        display: flex;
        flex-direction: row;

        gap: 1rem;
    }

</style>
