<script setup>
    import {RouterView, useRouter} from 'vue-router';
    const router = useRouter();
</script>



<template>
    <div class="app-container">
        <h1>Book App</h1>
        <RouterLink :to="`/`">Home Page</RouterLink><br>
        <RouterLink :to="`/book`">Add Book</RouterLink><br>
        <RouterLink :to="`/login`">Login</RouterLink><br>
        <RouterLink :to="`/register`">Register</RouterLink><br>
        <button @click="logout">Logout</button>
        <RouterView />
    </div>
</template>


