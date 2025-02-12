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

const goBack = () => router.go(-1);

</script>

<template>
    <h2>Add Book</h2>

    <form @submit.prevent="handleSubmit">
        <input type="text" v-model="title" placeholder="Title" required />
        <input type="text" v-model="author" placeholder="Author" required />
        <input type="number" v-model="release_year" placeholder="Release Year" required />
        <textarea v-model="description" placeholder="Description" required></textarea>
        <button type="submit" class="add-book">Add Book</button>
    </form>

    <button @click="goBack" class="go-back">Back</button>
</template>

<style scoped>
    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        max-width: 400px;
        margin-top: 1rem;
    }

    input,
    textarea {
        width: 100%;
        padding: 0.5rem;
        box-sizing: border-box;
        font-size: 1.2rem;
        font-family: "Noto sans";
    }

    textarea {
        display: block;
        width: 100%;
        max-width: 450px;
        min-height: 7rem;
        margin-top: 0.75rem;
        font-size: 1.2rem;
        padding: 0.5rem;
    }

    .add-book {
        padding: 0.5rem 1rem;
        font-size: 1.2rem;
    }


</style>
