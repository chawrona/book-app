<script setup>
    import { authStore } from '../store/auth';
    import { RouterLink } from 'vue-router';
</script>

<template>
    <div class="container">
        <div class="title">
            <h1>Book App</h1>
            <h2 class="author">Dawid Chawrona</h2>
        </div>

        <nav class="nav">
            <ul class="navList">
                <li v-if="authStore.isAuthenticated">
                    <RouterLink :to="`/`" class="navLink">Home Page</RouterLink>
                </li>
                <li v-if="authStore.isAuthenticated">
                    <RouterLink :to="`/book`" class="navLink">Add a Book</RouterLink>
                </li>
                <li v-if="authStore.isAuthenticated">
                    <button @click="authStore.logout" class="navLink">
                        <img :src="'/icons/logout.svg'" alt="Logout">
                    </button>
                </li>

                <li v-if="!authStore.isAuthenticated">
                    <RouterLink :to="`/login`" class="navLink">Login</RouterLink>
                </li>
                <li v-if="!authStore.isAuthenticated">
                    <RouterLink :to="`/register`" class="navLink">Register</RouterLink>
                </li>
            </ul>
        </nav>
    </div>
</template>


<style scoped>
    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #3c096c;
        color: white;
        padding: 1rem;

        h1, h2 {
            text-shadow: 2px 2px 5px #240046;
        }

        h2 {
            font-size: 1.5rem;

        }
    }

    .navList {
        display: flex;
        list-style: none;
        align-items: center;
        gap: 1rem;
    }

    .navLink {
        display: block;
        border: none;
        background-color: white;
        border-radius: 0.25rem;
        text-decoration: none;
        padding: 1rem 1.5rem;
        font-size: 1.05rem;
        color: #5a189a;
        cursor: pointer;

        &:hover {
            text-decoration: underline;
            background-color: rgba(255, 255, 255, 0.857);
        }
    }

    .navLink:has(img) {
        padding: 0.655rem 1rem;
    }

    img {
        height: 1.75rem;
    }

</style>
