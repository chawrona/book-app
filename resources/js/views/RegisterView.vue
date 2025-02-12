<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from "vue-router";

const router = useRouter();
const name = ref("");
const email = ref("");
const password = ref("");
const passwordConfirmation = ref("");
const error = ref("");

const handleRegister = async () => {
  try {
    await axios.post("/api/register", {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: passwordConfirmation.value,
    });

    router.push("/login");
  } catch (error) {
    error.value = "Registration failed. Please try again.";
  }
};


</script>

<template>
  <h2>Register</h2>
  <h3 v-if="error">{{ error }}</h3>
  <form @submit.prevent="handleRegister" autocomplete="off">
    <input type="text" required v-model="name" placeholder="Name">
    <input type="email" required v-model="email" placeholder="Email">
    <input type="password" required autocomplete="new-password" v-model="password" placeholder="Password">
    <input type="password" required v-model="passwordConfirmation" placeholder="Confirm Password">
    <input type="submit" value="Register">
  </form>
</template>
