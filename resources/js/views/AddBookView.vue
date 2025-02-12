<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from "vue-router";

const title = ref('');
const author = ref('');
const release_year = ref('');
const description = ref('');

const router = useRouter();

const handleSubmit = async () => {
  try {
    await axios.post('/api/books', {
      title: title.value,
      author: author.value,
      release_year: release_year.value,
      description: description.value,
    });

    router.push("/");
  } catch (error) {
    console.error('Error adding book:', error);
  }
};

</script>

<template>
  <form @submit.prevent="handleSubmit">
    <input type="text" v-model="title" placeholder="Title" required />
    <input type="text" v-model="author" placeholder="Author" required />
    <input type="number" v-model="release_year" placeholder="Release Year" required />
    <textarea v-model="description" placeholder="Description" required></textarea>
    <button type="submit">Add</button>
  </form>
</template>

<style scoped>
form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  max-width: 400px;
}

input,
textarea {
  width: 100%;
  padding: 0.5rem;
  box-sizing: border-box;
}
</style>
