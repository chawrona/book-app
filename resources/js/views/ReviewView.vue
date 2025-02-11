<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const reviewContent = ref('');
const rate = ref(null);
const error = ref('');

const bookId = route.params.id;
const reviewId = route.params.reviewId;

const apiPath = `/api/books/${bookId}/reviews/${reviewId}`;

const getReview = async () => {
  try {
    const response = await axios.get(apiPath);
    const data = response.data.data;
    reviewContent.value = data.review;
    rate.value = data.rate;
  } catch {
    error.value = 'Fasdsa';
  }
};

const updateReview = async () => {
  error.value = '';
  try {
    await axios.put(apiPath, {
      review: reviewContent.value,
      rate: rate.value,
    });
    router.push(`/book/${bookId}`);
  } catch {
    error.value = 'Failed to update review.' + error;
  }
};

const deleteReview = async () => {
  error.value = '';
  try {
    await axios.delete(apiPath);
    router.push(`/book/${bookId}`);
  } catch {
    error.value = 'Failed to delete review.';
  }
};

onMounted(getReview);
</script>

<template>


    <p v-if="error" style="color: red;">{{ error }}</p>
    <form @submit.prevent="updateReview">
        <textarea v-model="reviewContent" placeholder="Write your review here" required></textarea>
        <p>Select a rating:</p>

        <div v-for="n in 5" :key="n">
          <input type="radio" :id="'rate' + n" :value="n" v-model="rate" required />
          <label :for="'rate' + n">{{ n }}</label>
        </div>

      <button type="submit">Update Review</button>
    </form>

    <button @click="deleteReview" style="margin-top: 1rem;">Delete Review</button>

</template>
