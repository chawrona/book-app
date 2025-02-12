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

const goBack = () => router.go(-1);
</script>

<template>
    <p v-if="error" style="color: red;">{{ error }}</p>


    <h2>Add Review</h2>
    <h4>Select rating</h4>
    <form @submit.prevent="createReview">
        <div class="review-edit-wrap">
            <div v-for="n in 5" :key="n" class="review-edit-rating">
                <label :for="'rate' + n">{{ n }}</label>
                <input type="radio" :id="'rate' + n" :value="n" v-model="rate" required />
            </div>
        </div>

        <h4>Review</h4>
        <textarea v-model="reviewContent" placeholder="Write your review here" required class="review-textarea"></textarea>
        <button type="submit" class="update-review">Create review</button>
        <button @click="goBack" class="go-back">Back</button>
    </form>
</template>

<style scoped>
    .review-edit-wrap {
        display: flex;
        font-size: 1.2rem;
        gap: 2rem;
    }

    .review-edit-rating {
        display: flex;
        gap: 0.75rem;
        font-size: 1.3rem;
        padding: 1rem;
        label {
            cursor: pointer;
        }
    }

    .review-textarea {
        display: block;
        width: 100%;
        max-width: 450px;
        min-height: 7rem;
        margin-top: 0.75rem;
        font-size: 1.2rem;
        padding: 0.5rem;
    }

    .update-review, .delete-review, .go-back{
        font-size: 1.2rem;
        margin-top: 1rem;
        padding: 0.35rem 0.75rem;
        width: 12rem;
        display: block;
    }

</style>
