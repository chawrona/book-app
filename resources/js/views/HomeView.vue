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


const selectedSort = ref('');

const sortBooks = () => {
  switch (selectedSort.value) {
    case 'title':
      books.value.sort((a, b) => a.title.localeCompare(b.title));
      break;
    case 'author':
      books.value.sort((a, b) => a.author.localeCompare(b.author));
      break;
    case 'release_year':
      books.value.sort((a, b) => a.release_year - b.release_year);
      break;
    case 'avg':
      books.value.sort((a, b) => {
        const avgA = a.reviews ? a.reviews.reduce((acc, review) => acc + review.rate, 0) / a.reviews.length : 0;
        const avgB = b.reviews ? b.reviews.reduce((acc, review) => acc + review.rate, 0) / b.reviews.length : 0;
        return avgA - avgB;
      });
      break;
    default:
      break;
  }
};

onMounted(async () => {
    try {
        const response = await axios.get("/api/books");
        books.value = response.data.data;
    } catch (error) {
        router.push("/login");
    }
})

</script>

<template>
    <h2>Books</h2>

    <select v-model="selectedSort" @change="sortBooks">
  <option value="">Select sorting option</option>
  <option value="title">Sort by Title</option>
  <option value="author">Sort by Author</option>
  <option value="release_year">Sort by Year</option>
  <option value="avg">Sort by Average Rating</option>
</select>

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
