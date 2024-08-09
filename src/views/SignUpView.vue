<template>
  <main class="relative flex-grow lg:h-screen lg:bg-cyan-50 lg:flex justify-center lg:px-8">
    <CommetIcon
      class="fixed lg:static top-[50%] lg:top-auto left-[50%] lg:left-auto translate-y-[-50%] lg:translate-y-0 translate-x-[-50%] lg:translate-x-0 h-[50%] md:h-[40%] lg:h-auto w-auto lg:w-[450px]"
    />
    <div
      id="me"
      class="absolute lg:static top-0 lg:top-auto left-0 lg:left-auto min-h-screen w-full lg:w-2/5 z-10 flex items-center justify-center bg-cyan-50 lg:bg-transparent bg-opacity-75"
    >
      <form
        @submit.prevent="registerUser()"
        class="md:w-2/3 lg:w-full flex flex-col items-center justify-center gap-8 p-4 lg:p-0"
      >
        <div class="flex flex-col items-center gap-2">
          <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold uppercase text-center">
            Welcome to commet
          </h1>
          <span class="text-lg md:text-xl capitalize">Comment every thing</span>
        </div>
        <div class="w-full lg:max-w-[600px] flex flex-col gap-4 rounded-xl p-4">
          <div>
            <div v-if="errors.username">
              <span
                class="text-red-500 text-sm font-semibold"
                v-for="error in errors.username"
                :key="error"
                >{{ error }}</span
              >
            </div>
            <input
              type="text"
              placeholder="Username"
              v-model="username"
              name="username"
              class="w-full border border-gray-300 bg-transparent p-2 rounded-md focus:outline-none md:text-lg placeholder:text-gray-700"
            />
          </div>
          <div>
            <div v-if="errors.email">
              <span
                class="text-red-500 text-sm font-semibold"
                v-for="error in errors.email"
                :key="error"
                >{{ error }}</span
              >
            </div>
            <input
              type="email"
              placeholder="Email"
              v-model="email"
              name="email"
              class="w-full border border-gray-300 bg-transparent p-2 rounded-md focus:outline-none md:text-lg placeholder:text-gray-700"
            />
          </div>
          <div>
            <div v-if="errors.birthdate">
              <span
                class="text-red-500 text-sm font-semibold"
                v-for="error in errors.birthdate"
                :key="error"
                >{{ error }}</span
              >
            </div>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg
                  class="w-4 h-4 text-gray-500 dark:text-gray-400"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                  />
                </svg>
              </div>
              <input
                id="datepicker-autohide"
                datepicker
                datepicker-autohide
                datepicker-format="yyyy/mm/dd"
                type="text"
                class="bg-transparent border border-gray-300 placeholder:text-gray-700 md:text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2"
                placeholder="Birthdate"
              />
            </div>
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
              placeholder="Password"
              v-model="password"
              name="password"
              class="w-full border border-gray-300 bg-transparent p-2 rounded-md focus:outline-none md:text-lg placeholder:text-gray-700"
            />
          </div>
          <input
            type="password"
            placeholder="Confirm password"
            v-model="password_confirmation"
            name="password_confirmation"
            class="border border-gray-300 bg-transparent p-2 rounded-md focus:outline-none md:text-lg placeholder:text-gray-700"
          />
          <div class="flex items-center">
            <input
              id="default-checkbox"
              type="checkbox"
              v-model="remember_me"
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
              Register
            </button>
          </div>
        </div>
        <div class="flex gap-2 justify-center text-lg">
          <span>Already have an account?</span
          ><RouterLink to="/login" class="text-[#009DFF] font-semibold">Log in</RouterLink>
        </div>
      </form>
    </div>
  </main>
</template>

<script setup>
import CommetIcon from '@/components/icons/CommetIcon.vue'
import { ref } from 'vue'
import { RouterLink } from 'vue-router'
import { AuthService } from '@/services/auth'
import router from '@/router'
import { UseToaster } from '@/stores/toaster'

const toaster = UseToaster()

let username = ref('')
let email = ref('')
let birthdate = ref('')
let password = ref('')
let password_confirmation = ref('')
let remember_me = ref('')

let errors = ref({})
let loading = ref(false)

const registerUser = async () => {
  loading.value = true
  birthdate.value = document.getElementById('datepicker-autohide').value

  const user = {
    username: username.value,
    email: email.value,
    birthdate: birthdate.value,
    password: password.value,
    password_confirmation: password_confirmation.value
  }

  let response = await AuthService.register(user)

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
