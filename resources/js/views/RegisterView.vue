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
        <button type="submit" value="Register" class="register">Register</button>
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

    .register {
        padding: 0.75rem 1rem;
        font-size: 1.2rem;
    }

</style>
