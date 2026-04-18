<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
      
      <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">
        Admin Login
      </h2>

      <!-- Error -->
      <p v-if="error" class="text-red-500 text-sm mb-4">
        {{ error }}
      </p>

      <!-- Email -->
      <div class="mb-4">
        <label class="block text-gray-600 mb-1">Email</label>
        <input 
          v-model="email"
          type="email"
          placeholder="Enter your email"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label class="block text-gray-600 mb-1">Password</label>
        <input 
          v-model="password"
          type="password"
          placeholder="Enter your password"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <!-- Button -->
      <button 
        @click="login"
        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
      >
        Login
      </button>

      <!-- Get User -->
      <button 
        @click="getUser"
        class="w-full mt-3 border border-gray-300 py-2 rounded-lg hover:bg-gray-100"
      >
        Get User
      </button>

    </div>

  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      email: '',
      password: '',
      token: '',
      error: ''
    }
  },
  methods: {
    async login() {
      this.error = ''

      try {
        const res = await axios.post('/api/login', {
          email: this.email,
          password: this.password
        })

        this.token = res.data.access_token
        localStorage.setItem('token', this.token)

        alert('Login successful ✅')

      } catch (err) {
        this.error = 'Invalid email or password ❌'
      }
    },

    async getUser() {
      try {
        const token = localStorage.getItem('token')

        const res = await axios.get('/api/me', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })

        console.log(res.data)
        alert('User fetched ✅')

      } catch (err) {
        this.error = 'Unauthorized ❌'
      }
    }
  }
}
</script>