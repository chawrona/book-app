<script setup>
import {ref} from 'vue';
import { useRouter } from "vue-router";
import { authStore } from '../store/auth';

const router = useRouter();
const email = ref("")
const password = ref("")
const error = ref("")

const handleLogIn = async () => {
  try {
    await authStore.login({
      email: email.value,
      password: password.value,
    })
  } catch (error) {
    error.value = "Incorrect credentials."
  }
};

</script>

<template>
    <h2>Log in</h2>
    <h3 v-if="error">{{ error }}</h3>
    <form @submit.prevent="handleLogIn">
        <input type="email"  required v-model="email" placeholder="E-mail">
        <input type="password" required v-model="password" placeholder="Password">
        <button type="submit" class="login">Log in </button>
    </form>
</template>

<style scoped>
    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        max-width: 400px;
        margin-top: 1.5rem;
    }

    input,
    textarea {
        width: 100%;
        padding: 0.75rem;
        box-sizing: border-box;
        font-size: 1.2rem;
        font-family: "Noto sans";
    }

    textarea {
        display: block;
        width: 100%;
        max-width: 450px;
        min-height: 7rem;
        margin-top: 0.75rem;
        font-size: 1.2rem;
        padding: 0.5rem;
    }

    .login {
        padding: 0.75rem 1rem;
        font-size: 1.2rem;
    }

</style>
