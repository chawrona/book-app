<script setup>
import {ref} from 'vue';
import { useRouter } from "vue-router";
import { authStore } from '@/store';

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
        <input type="email"  required v-model="email" placeholder="e-mail">
        <input type="password" required v-model="password" placeholder="password">
        <input type="submit">
    </form>
</template>
