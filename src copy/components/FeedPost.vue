<template>
  <button @click="seeDetails()" class="w-full flex flex-col gap-4 bg-white rounded lg:rounded-xl p-2 md:p-4">
    <div class="w-full flex justify-between">
      <div class="flex gap-4">
        <img src="https://i.imgur.com/DmleYGf.jpg" class="w-12 md:w-20 rounded" alt="" />
        <div class="flex flex-col justify-between font-semibold">
          <span class="text-cyan-500 md:text-xl">{{ post.user.username }}</span>
          <span class="text-xs md:text-sm">2 days ago</span>
        </div>
      </div>
      <div v-if="post.user.id === store.userData.user.id" class="relative">
        <div
          v-show="showMenu"
          class="absolute top-6 lg:top-8 left-2 lg:left-4 translate-x-[-100%] lg:translate-x-0 flex flex-col bg-white text-sm md:text-base border border-black rounded shadow-xl z-10"
        >
          <button @click="editPost()" class="border-b px-2 py-1 border-black">Update</button>
          <button @click="deletePost()" class="text-red-500 px-2 py-1 border-black">Delete</button>
        </div>
        <button @click="toggleMenu()"><ThreeDotsIcon /></button>
      </div>
    </div>
    <span class="text-lg">{{ post.content }}</span>
    <button
      @click="goTo((post.link.substring(0, 4) === 'http' ? '' : 'http://') + post.link)"
      class="relative w-full bg-black bg-opacity-50 rounded"
    >
      <CommetLogoIcon class="w-full h-auto aspect-video" />
      <div
        class="absolute top-0 left-0 h-full w-full flex flex-col justify-between bg-black bg-opacity-20 font-semibold text-white p-2 md:p-4"
      >
        <div>
          <div class="w-full flex justify-between items-center">
            <span class="md:text-lg">{{ post.title }}</span>
          </div>
        </div>
        <div class="w-full flex justify-between items-center md:text-lg">
          <div class="flex gap-2">
            <span v-for="tag in post.tags">{{ '#' + tag.name }}</span>
          </div>
          <div v-show="post.comments.length > 0" class="flex gap-2 items-center">
            <span>{{ post.comments.length }}</span>
            <CommentIcon class="h-5 w-auto text-cyan-500" />
          </div>
        </div>
      </div>
    </button>
  </button>
</template>

<script setup>
import ThreeDotsIcon from './icons/ThreeDotsIcon.vue'
import CommetLogoIcon from './icons/CommetLogoIcon.vue'
import CommentIcon from './icons/CommentIcon.vue'
import { onMounted, ref } from 'vue'
import { useStore } from '@/stores'
import { UseToaster } from '@/stores/toaster'
import router from '@/router'

const props = defineProps({
  post: Object
})

const store = useStore()
const toaster = UseToaster()

let showMenu = ref(false)

const toggleMenu = () => {
  showMenu.value = !showMenu.value
}

const seeDetails = () => {
    store.setSelectedPost(props.post)
    router.push('/details/user/' + props.post.user.id + '/post/' + props.post.id)
}

const editPost = () => {
  store.setSelectedPost(props.post)
  store.switchUpdatePanel(true)
  showMenu.value = false
}

const deletePost = async () => {
  let request = await store.deletePost(store.getUserId, props.post.id)

  if (request.ok) {
    showMenu.value = false
  } else {
    setTimeout(() => {
      toaster.triggerToast(request.message)
    }, 200)
  }
}

const goTo = (newLocation) => {
  window.location = newLocation
}
</script>
