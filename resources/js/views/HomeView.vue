setup
<script setup>
import {ref, onMounted} from 'vue';
import { useRouter } from "vue-router";

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
        console.error(error)
    }
})

</script>

<template>
    <h2 class="subtitle">Books</h2>

    <select v-model="selectedSort" @change="sortBooks" class="books-filter">
        <option value="">Select sorting option</option>
        <option value="title">Sort by Title</option>
        <option value="author">Sort by Author</option>
        <option value="release_year">Sort by Year</option>
        <option value="avg">Sort by Average Rating</option>
    </select>

    <table class="books-table">
        <tr v-for="book in books" :key="book.id">
            <td>{{ book.title }}</td>
            <td>{{ book.author }}</td>
            <td>{{ book.release_year }}</td>
            <td>Avg: {{ calculateAvg(book.reviews) }}</td>

            <RouterLink :to="`/book/${book.id}`" class="book">
                Check
            </RouterLink>
        </tr>
    </table>
</template>


<style scoped>
   
    .books-filter {
        padding: 0.5em 0.5em;
        font-size: 1.2rem;
    }

    .books-table {
        margin-top: 1rem;
        width: 100%;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.427);
        border-collapse: collapse;

        tr {

            background-color: #ff9e00;
        }

        tr:nth-last-of-type(2n) {
            background-color: #fff;
        }

        td {
            font-size: 1.1rem;
            padding: 1rem 1rem;
        }
    }

    .book {
        display: block;
        margin-left: auto;
        font-size: 1.1rem;
        padding: 1rem 1rem;
        font-weight: bold;

        &:hover {
            color: #9d4edd;
        }
    }

</style>
