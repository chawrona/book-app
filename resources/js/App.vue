<script setup>
    import {onMounted} from 'vue';
    import {RouterView, useRouter} from 'vue-router';


    const router = useRouter();

    // onMounted(async () => {
    //     try {
    //         let response = await axios.get("/api/user");
    //         response = await axios.get("/api/books");
    //         books.value = response.data.data;
    //     } catch (error) {
    //         router.push("/login");
    //     }
    // })

</script>



<template>
    <div class="app-container">
        <h1>Book App</h1>
        <RouterLink :to="`/`">Home Page</RouterLink><br>
        <RouterLink :to="`/book`">Add Book</RouterLink>
        <RouterView />
    </div>
</template>


