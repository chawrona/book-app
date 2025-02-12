<script setup>
    import {RouterView} from 'vue-router';
    import Navbar from './components/Navbar.vue';
</script>

<template>
    <div>
        <Navbar />
        <div :class="$style.container">
            <RouterView />
        </div>
    </div>
</template>


<style module>
    .container {
        width: 100%;
        max-width: 800px;
        margin-inline: auto;
        padding-top: 2rem;
        padding-bottom: 4rem;
    }
</style>

