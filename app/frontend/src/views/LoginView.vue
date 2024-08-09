<template>
  <main class="relative flex-grow lg:h-screen lg:bg-cyan-50 lg:flex justify-center lg:px-8">
    <div
      id="me"
      class="absolute lg:static top-0 lg:top-auto left-0 lg:left-auto min-h-screen w-full lg:w-2/5 z-10 flex items-center justify-center bg-cyan-50 lg:bg-transparent bg-opacity-75"
    >
      <form
        @submit.prevent="tryLogin()"
        class="md:w-2/3 lg:w-full flex flex-col items-center justify-center gap-8 p-4 lg:py-8 rounded-2xl"
      >
        <div class="flex flex-col items-center gap-2">
          <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold uppercase text-center">
            Welcome to commet
          </h1>
          <span class="text-lg md:text-xl capitalize">Comment every thing</span>
        </div>
        <div class="w-full lg:max-w-[600px] flex flex-col gap-8 rounded-xl p-4">
          <div>
            <div v-if="errors.login">
              <span
                class="text-red-500 text-sm font-semibold"
                v-for="error in errors.login"
                :key="error"
                >{{ error }}</span
              >
            </div>
            <input
              type="text"
              placeholder="Login (username or email)"
              name="login"
              v-model="login"
              class="w-full border border-gray-300 bg-transparent p-2 rounded-md focus:outline-none md:text-lg placeholder:text-gray-700"
            />
          </div>
          <div>
            <div v-if="errors.password">
              <span
                class="text-red-500 text-sm font-semibold"
                v-for="error in errors.password"
                :key="error"
                >{{ error }}</span
              >
            </div>
            <input
              type="password"
              v-model="password"
              name="password"
              placeholder="Password"
              class="w-full border border-gray-300 bg-transparent p-2 rounded-md focus:outline-none md:text-lg placeholder:text-gray-700"
            />
          </div>
          <div class="flex items-center">
            <input
              id="default-checkbox"
              type="checkbox"
              value=""
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />
            <label for="default-checkbox" class="ms-2 font-medium text-gray-900 dark:text-gray-300"
              >Remember me</label
            >
          </div>
          <div class="relative">
            <div
              v-if="loading"
              class="absolute h-full w-full bg-cyan-100 bg-opacity-50 rounded-full"
            >
              <div class="h-full flex space-x-2 justify-center items-center">
                <span class="sr-only">Loading...</span>
                <div
                  class="h-4 w-4 bg-black rounded-full animate-bounce [animation-delay:-0.3s]"
                ></div>
                <div
                  class="h-4 w-4 bg-cyan-600 rounded-full animate-bounce [animation-delay:-0.15s]"
                ></div>
                <div class="h-4 w-4 bg-cyan-400 rounded-full animate-bounce"></div>
              </div>
            </div>
            <button
              type="submit"
              class="w-full bg-black p-4 rounded-full text-white md:text-lg font-semibold"
            >
              Log in
            </button>
          </div>
        </div>
        <div class="flex gap-2 justify-center text-lg">
          <span>Don't have an account yet?</span
          ><RouterLink to="/register" class="text-[#009DFF] font-semibold">Sign up</RouterLink>
        </div>
      </form>
    </div>
    <CommetIcon
      class="fixed lg:static top-[50%] lg:top-auto left-[50%] lg:left-auto translate-y-[-50%] lg:translate-y-0 translate-x-[-50%] lg:translate-x-0 h-[50%] md:h-[40%] lg:h-auto w-auto lg:w-[450px]"
    />
  </main>
</template>

<script setup>
import CommetIcon from '@/components/icons/CommetIcon.vue'
import router from '@/router'
import { AuthService } from '@/services/auth'
import { ref } from 'vue'
import { RouterLink } from 'vue-router'
import { UseToaster } from '@/stores/toaster'

const toaster = UseToaster()

let login = ref('')
let password = ref('')

let errors = ref({})
let loading = ref(false)

const tryLogin = async () => {
  loading.value = true

  const credentials = {
    login: login.value,
    password: password.value
  }

  let response = await AuthService.login(credentials)

  if (response.ok) {
    loading.value = false
    router.push('/')
  } else {
    loading.value = false
    if (response.errors) {
      errors.value = response.errors
    } else {
      setTimeout(() => {
        toaster.triggerToast(response.message)
      }, 200)
    }
  }
}
</script>
