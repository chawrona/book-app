setup
<script setup>
import {ref, onMounted} from 'vue';
import { useRoute } from 'vue-router';
import { useRouter } from "vue-router";

const router = useRouter();

const route = useRoute();

const books = ref([])

const calculateAvg = (reviews) => {
  if (!reviews || reviews.length === 0) return 'No reviews';
  let total = reviews.reduce((sum, review) => sum + review.rate, 0);
  return (total / reviews.length).toFixed(1);
};


const sortBooks = (criteria) => {
  books.value.sort((a, b) => {
    if (criteria === 'title') return a.title.localeCompare(b.title);
    if (criteria === 'author') return a.author.localeCompare(b.author);
    if (criteria === 'release_year') return a.release_year - b.release_year;
    if (criteria === 'avg') {
      const avgA = a.reviews && a.reviews.length ? a.reviews.reduce((s, r) => s + r.rate, 0) / a.reviews.length : 0;
      const avgB = b.reviews && b.reviews.length ? b.reviews.reduce((s, r) => s + r.rate, 0) / b.reviews.length : 0;
      return avgB - avgA;
    }
  });
};

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

    <div>
        <button @click="sortBooks('title')">Sort by Title</button>
        <button @click="sortBooks('author')">Sort by Author</button>
        <button @click="sortBooks('release_year')">Sort by Year</button>
        <button @click="sortBooks('avg')">Sort by Average Rating</button>
    </div>

    <ul>
        <li v-for="book in books" :key="book.id">
            <span>{{ book.title }}</span>
            <span>{{ book.author }}</span>
            <span>{{ book.release_year }}</span>
            <span>Avg: {{ calculateAvg(book.reviews) }}</span>
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
