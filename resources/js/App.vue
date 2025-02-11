<script setup>
    import {onMounted} from 'vue';
    import {RouterView, useRouter} from 'vue-router';




    const router = useRouter();

    const logout = async () => {
        try {
            await axios.post('/api/logout');
            router.push('/login');
        } catch (error) {
            console.error('Logout failed', error);
        }
        };

</script>



<template>
    <div class="app-container">
        <h1>Book App</h1>
        <RouterLink :to="`/`">Home Page</RouterLink><br>
        <RouterLink :to="`/book`">Add Book</RouterLink><br>
        <button @click="logout">Logout</button>
        <RouterView />
    </div>
</template>


