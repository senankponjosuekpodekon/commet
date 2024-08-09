<template>
  <div
    class="absolute h-full w-full flex flex-col lg:flex-row justify-center items-center bg-cyan-50 lg:gap-4 z-30"
  >
    <CommetLogoIcon class="hidden lg:block logo" />
    <CommetIcon class="lg:hidden w-3/4 md:w-1/2 logo" />
    <div class="flex space-x-2 justify-center items-center dark:invert">
      <span class="sr-only">Loading...</span>
      <div class="h-4 w-4 bg-black rounded-full animate-bounce [animation-delay:-0.3s]"></div>
      <div class="h-4 w-4 bg-cyan-600 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
      <div class="h-4 w-4 bg-cyan-400 rounded-full animate-bounce"></div>
    </div>
  </div>
</template>

<script setup>
import CommetLogoIcon from './icons/CommetLogoIcon.vue'
import CommetIcon from './icons/CommetIcon.vue'
</script>

<style scoped>
.logo {
  animation: shine 2s infinite;
}

@keyframes shine {
  10% {
    opacity: 85%;
  }

  20% {
    opacity: 70%;
  }

  30% {
    opacity: 55%;
  }

  40% {
    opacity: 40%;
  }

  50% {
    opacity: 25%;
  }

  60% {
    opacity: 40%;
  }

  70% {
    opacity: 55%;
  }

  80% {
    opacity: 70%;
  }

  90% {
    opacity: 85%;
  }

  100% {
    opacity: 100%;
  }
}
</style>
