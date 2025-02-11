<script setup>
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const reviewContent = ref('');
const rate = ref(null);
const error = ref('');

const bookId = route.params.id;
const apiPath = `/api/books/${bookId}/reviews`;

const createReview = async () => {
  error.value = '';
  try {
    await axios.post(apiPath, {
      review: reviewContent.value,
      rate: rate.value,
    });
    router.push(`/book/${bookId}`);
  } catch (err) {
    error.value = 'Failed to create review: ' + err.message;
  }
};
</script>

<template>
  <p v-if="error" style="color: red;">{{ error }}</p>
  <form @submit.prevent="createReview">
    <textarea v-model="reviewContent" placeholder="Write your review here" required></textarea>
    <p>Select a rating:</p>
    <div v-for="n in 5" :key="n">
      <input type="radio" :id="'rate' + n" :value="n" v-model="rate" required />
      <label :for="'rate' + n">{{ n }}</label>
    </div>
    <button type="submit">Create review</button>
  </form>
</template>
