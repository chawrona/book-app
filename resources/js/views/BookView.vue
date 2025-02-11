setup
<script setup>
import { ref, onMounted, computed  } from 'vue';
import { useRoute } from 'vue-router';
import { useRouter } from "vue-router";

const router = useRouter();
const book = ref([]);
const route = useRoute();

const selectedRate = ref(null);

const filteredReviews = computed(() => {
  if (!book.value.reviews) return [];
  return selectedRate.value === null
    ? book.value.reviews
    : book.value.reviews.filter(review => review.rate === selectedRate.value);
});

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
        <h4>{{ book.author }}</h4>
        <h4>{{ book.release_year }}</h4>
        <p>{{ book.description }}</p>

        <RouterLink v-if="book.reviews && book.reviews.every(review => !review.is_owner)" :to="`/book/${book.id}/review`">add review</RouterLink>

        <div>
            <button @click="selectedRate = null">All</button>
            <button @click="selectedRate = 1">1</button>
            <button @click="selectedRate = 2">2</button>
            <button @click="selectedRate = 3">3</button>
            <button @click="selectedRate = 4">4</button>
            <button @click="selectedRate = 5">5</button>
        </div>

        <ul v-if="book.reviews">
            <li v-for="review in filteredReviews" :key="review.id">
                <p>{{ review.review }}</p>
                <p>Rating: {{ review.rate }} / 5</p>
                <RouterLink v-if="review.is_owner" :to="`/book/${book.id}/review/${review.id}`">Edit review</RouterLink>
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
