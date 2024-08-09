<template>
  <div class="w-full flex flex-col gap-2">
    <h2 class="font-semibold text-black text-opacity-50 md:text-lg">Trending</h2>
    <div class="w-full overflow-x-scroll" id="trending-section">
      <div class="min-w-full w-fit flex gap-4">
        <TrendingPost v-for="post in trending" :key="post.id" :post="post" />
      </div>
    </div>
  </div>
</template>

<script setup>
import TrendingPost from './TrendingPost.vue'

const props = defineProps({
  trending: Array
})
</script>
