<template>
  <button @click="" class="relative min-w-[75%] md:min-w-[40%] lg:min-w-[25%] aspect-video bg-black bg-opacity-50 rounded-[5px] md:rounded-lg">
    <CommetLogoIcon class="h-full w-full" />
    <div
      class="absolute top-0 left-0 h-full w-full flex flex-col justify-between bg-black bg-opacity-20 text-sm md:text-base font-semibold text-white p-2 rounded-[5px] md:rounded-lg"
    >
      <div class="w-full flex justify-between items-center">
        <span>{{ post.title }}</span>
        <div class="flex gap-2 items-center">
          <span>{{ post.comments.length }}</span>
          <CommentIcon class="h-5 w-auto text-cyan-500" />
        </div>
      </div>
      <div class="w-full flex justify-between items-center">
        <div class="flex gap-2">
          <span v-for="tag in post.tags">{{ '#' + tag.name }}</span>
        </div>
        <button @click="goTo((post.link.substring(0, 4) === 'http' ? '' : 'http://') + post.link)">
          <GotoIcon class="text-white" />
        </button>
      </div>
    </div>
  </button>
</template>

<script setup>
import GotoIcon from './icons/GotoIcon.vue'
import CommetLogoIcon from './icons/CommetLogoIcon.vue'
import CommentIcon from './icons/CommentIcon.vue'

const props = defineProps({
  post: Object
})

const goTo = (newLocation) => {
  window.location = newLocation
}
</script>
