<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">

      <h2 class="text-2xl font-bold text-center mb-6">
        Login Page
      </h2>

      <!-- Already logged in message -->
      <p v-if="isLoggedIn" class="text-green-600 text-center mb-4">
        You are already logged in 
      </p>

      <!-- Error -->
      <p v-if="error" class="text-red-500 text-sm mb-3 text-center">
        {{ error }}
      </p>

      <!-- Email -->
      <input
        v-model="email"
        type="email"
        placeholder="Email"
        class="w-full mb-3 px-4 py-2 border rounded-lg"
      />

      <!-- Password -->
      <input
        v-model="password"
        type="password"
        placeholder="Password"
        class="w-full mb-4 px-4 py-2 border rounded-lg"
      />

      <!-- Login Button -->
      <button
        @click="login"
        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
      >
        Login
      </button>

      <!-- Check Button -->
      <button
        @click="checkLogin"
        class="w-full mt-3 border py-2 rounded-lg hover:bg-gray-100"
      >
        Check Login Status
      </button>

    </div>

  </div>
</template>

<script>
import axios from "axios"

export default {
  data() {
    return {
      email: "",
      password: "",
      error: "",
      isLoggedIn: false,
    }
  },

  mounted() {
    this.checkLogin()
  },

  methods: {

    checkLogin() {
      const token = localStorage.getItem("token")

      if (token) {
        this.isLoggedIn = true

        // optional redirect
        this.$router.push('/dashboard')
      } else {
        this.isLoggedIn = false
      }
    },

    async login() {
      this.error = ""

      try {
        const res = await axios.post("/api/login", {
          email: this.email,
          password: this.password
        })

        localStorage.setItem("token", res.data.access_token)

        this.isLoggedIn = true

        alert("Login success ")

        // redirect optional
        this.$router.push("/dashboard")

      } catch (err) {
        this.error = "Invalid credentials"
      }
    }

  }
}
</script>