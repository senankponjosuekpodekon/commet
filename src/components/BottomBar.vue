<template>
  <div class="lg:hidden w-full flex md:justify-center p-4 pb-6 md:pb-8 z-20">
    <div class="w-full md:w-2/3 flex justify-between bg-white p-2 md:p-4 px-4 md:px-8 rounded-full">
      <div class="w-1/3 flex justify-between">
        <RouterLink to="/" class="text-black text-opacity-50" active-class="text-cyan-500 text-opacity-100">
          <HomeIcon class="h-8 md:h-10 w-auto" />
        </RouterLink>
        <button class="text-black text-opacity-50">
          <SearchIcon class="h-8 md:h-10 w-auto" />
        </button>
      </div>
      <RouterLink to="/login" class="text-black text-opacity-50" active-class="text-blue-700 text-opacity-100">
        <FollowsIcon class="h-8 md:h-10 w-auto" />
      </RouterLink>
    </div>
    <div
      class="absolute top-[50%] left-[50%] translate-y-[-50%] translate-x-[-50%] h-16 md:h-24 w-16 md:w-24 flex justify-center items-center bg-white rounded-full"
    >
      <button @click="store.switchCreatePanel(true)" class="text-black text-opacity-50 m-5 p-2 rounded-full"><AddPostIcon class="h-10 md:h-12 w-auto" /></button>
    </div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import SearchIcon from './icons/SearchIcon.vue'
import HomeIcon from './icons/HomeIcon.vue'
import FollowsIcon from './icons/FollowsIcon.vue'
import AddPostIcon from './icons/AddPostIcon.vue'
import { useStore } from '@/stores'

const store = useStore()
</script>
