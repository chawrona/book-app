<script setup>
    import {RouterView} from 'vue-router';
</script>

<template>
    <div class="app-container">
        <h1>Book App</h1>
        <RouterLink :to="`/`">Home Page</RouterLink><br>
        <RouterLink :to="`/book`">Add Book</RouterLink>
        <RouterView />
    </div>
</template>


