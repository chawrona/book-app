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
        const response = await axios.get(`/api/books/${route.params.id}`);
        book.value = response.data.data;
        console.log(book.value.reviews);

    } catch (error) {
        console.error(error)
    }
});

const goBack = () => router.go(-1);

</script>

<template>
    <h2>{{ book.title }}</h2>

   <div v-if="book">
        <h3>{{ book.author }}</h3>
        <h4>{{ book.release_year }}</h4>
        <p class="description">{{ book.description }}</p>

        <RouterLink
                v-if="book.reviews && book.reviews.every(review => !review.is_owner)"
                :to="`/book/${book.id}/review`"
                class="add-review"
            >
            Add review
        </RouterLink>

        <div class="rates">
            <button @click="selectedRate = null">All</button>
            <button @click="selectedRate = 1">1</button>
            <button @click="selectedRate = 2">2</button>
            <button @click="selectedRate = 3">3</button>
            <button @click="selectedRate = 4">4</button>
            <button @click="selectedRate = 5">5</button>
        </div>

        <ul v-if="book.reviews" class="review-list">
            <li v-for="review in filteredReviews" :key="review.id" class="review">
                <p class="review-name">{{ review.username }}</p>
                <p class="review-content">{{ review.review }}</p>
                <p class="review-rating">Rating: {{ review.rate }} / 5</p>
                <RouterLink v-if="review.is_owner" :to="`/book/${book.id}/review/${review.id}`" class="review-edit">Edit review</RouterLink>
            </li>
        </ul>
        <button @click="goBack" class="go-back">Back</button>
    </div>

</template>


<style scoped>

.description {
    margin: 1em 0;
}

.review-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    list-style: none;
}

.review-name {
    font-size: 1.2rem;
    font-weight: bold;
}

.review-rating {
    font-size: 1rem;
}

.review-edit {
    display: block;
    margin-top: 0.25em;
    font-size: 1.2rem;
}

.rates {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 1rem 0;
}

.rates button:not(:first-of-type) {
    clip-path: polygon(50% 0,
    calc(50%*(1 + sin(.4turn))) calc(50%*(1 - cos(.4turn))),
    calc(50%*(1 - sin(.2turn))) calc(50%*(1 - cos(.2turn))),
    calc(50%*(1 + sin(.2turn))) calc(50%*(1 - cos(.2turn))),
    calc(50%*(1 - sin(.4turn))) calc(50%*(1 - cos(.4turn)))
   );

   height: 5rem;
   width: 5.5rem;
   background-color: gold;
   cursor: pointer;
   font-weight: bold;
   font-size: 1.2rem;

   &:hover {
        background-color: rgb(220, 188, 10);
   }
}

.rates button:first-of-type {
    width: 5rem;
    height: 2.5rem;
    font-size: 1.5rem;
    font-weight: bold;
    border: 1px solid black;
    background-color: #fff;
    cursor: pointer;

    &:hover {
        background-color: #eaeaea;
    }
}

.add-review {
    font-size: 1.2rem;
}

</style>
