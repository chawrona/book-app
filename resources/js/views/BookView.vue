setup
<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useRouter } from "vue-router";

const router = useRouter();
const book = ref([]);
const route = useRoute();

onMounted(async () => {
    try {
        let response = await axios.get("/api/user");
        response = await axios.get(`/api/books/${route.params.id}`);
        book.value = response.data.data;
        console.log(book.value.reviews);

    } catch (error) {
        router.push("/login");
    }
});

</script>

<template>
    <h2>Books</h2>

    <div v-if="book">

        <h3>{{ book.title }}</h3>
        <h4>{{ book.author  }}</h4>
        <h4>{{ book.release_year }}</h4>
        <p>{{ book.description }}</p>

        <ul v-if="book.reviews">
            <li v-for="review in book.reviews" :key="review.id">
                <p>{{ review.review }}</p>
                <p>Rating: {{ review.rate }} / 5</p>
                <p v-if="review.is_owner">You are the owner of this review.</p>
            </li>
        </ul>

    </div>

</template>


<style scoped>
li {
    display: flex;
    flex-direction: row;

    gap: 1rem;
}

</style>
