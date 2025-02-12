<script setup>
import {ref, onMounted} from 'vue';
import { useRouter } from "vue-router";

const router = useRouter();
const email = ref("")
const password = ref("")
const error = ref("")

const handleLogIn = async () => {
  try {
    const response = await axios.post("/api/login", {
      email: email.value,
      password: password.value,
    });

    localStorage.setItem("token", response.data.token);
    axios.defaults.headers.common["Authorization"] = `Bearer ${response.data.token}`;
    router.push("/")
  } catch (error) {
    error.value = "Incorrect credentials."
  }
};

onMounted(async () => {
    try {
    const response = await axios.get("/api/user");
    if (response.data) router.push("/")
  } catch (error) {
    console.log("Not logged in");
  }
})

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
