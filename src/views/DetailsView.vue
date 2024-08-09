<template>
  <main class="h-full">
    <UpdatePostPanel v-if="store.showUpdatePanel" />
    <LoadView v-if="loading" />
    <div v-else class="h-full w-full bg-opacity-50 p-2 lg:p-0 md:p-4 pb-4 lg:pb-16">
      <div class="h-full lg:flex lg:gap-4 lg:bg-cyan-100 lg:m-8 lg:pl-24 rounded-b-[35px]">
        <div class="hidden lg:block flex-grow p-2 lg:rounded-b-[35px]"></div>
        <div
          id="lg-scrollable"
          class="h-full lg:overflow-y-auto w-full lg:w-full flex flex-col lg:items-center md:gap-2 bg-cyan-100 bg-opacity-50 p-2 lg:pt-24 md:p-4 mt-20 md:mt-24 lg:mt-0 rounded-b-[25px] lg:rounded-none lg:rounded-br-[35px]"
        >
          <div
            class="w-full lg:w-1/2 flex flex-col gap-4 bg-white rounded lg:rounded-xl p-2 md:p-4"
          >
            <div class="w-full flex justify-between">
              <div class="flex gap-4">
                <img src="https://i.imgur.com/DmleYGf.jpg" class="w-12 md:w-20 rounded" alt="" />
                <div class="flex flex-col justify-between font-semibold">
                  <span class="text-cyan-500 md:text-xl">{{
                    store.selectedPost.user.username
                  }}</span>
                  <span class="text-xs md:text-sm">2 days ago</span>
                </div>
              </div>
              <div v-if="store.selectedPost.user.id === store.userData.user.id" class="relative">
                <div
                  v-show="showMenu"
                  class="absolute top-6 lg:top-8 left-2 lg:left-4 translate-x-[-100%] lg:translate-x-0 flex flex-col bg-white text-sm md:text-base border border-black rounded shadow-xl z-10"
                >
                  <button @click="editPost()" class="border-b px-2 py-1 border-black">
                    Update
                  </button>
                  <button @click="deletePost()" class="text-red-500 px-2 py-1 border-black">
                    Delete
                  </button>
                </div>
                <button @click="toggleMenu()"><ThreeDotsIcon /></button>
              </div>
            </div>
            <span class="text-lg">{{ store.selectedPost.content }}</span>
            <button
              @click="
                goTo(
                  (store.selectedPost.link.substring(0, 4) === 'http' ? '' : 'http://') +
                    store.selectedPost.link
                )
              "
              class="relative w-full bg-black bg-opacity-50 rounded"
            >
              <CommetLogoIcon class="w-full h-auto aspect-video" />
              <div
                class="absolute top-0 left-0 h-full w-full flex flex-col justify-between bg-black bg-opacity-20 font-semibold text-white p-2 md:p-4"
              >
                <div>
                  <div class="w-full flex justify-between items-center">
                    <span class="md:text-lg">{{ store.selectedPost.title }}</span>
                  </div>
                </div>
                <div class="w-full flex justify-between items-center md:text-lg">
                  <div class="flex gap-2">
                    <span v-for="tag in store.selectedPost.tags">{{ '#' + tag.name }}</span>
                  </div>
                  <div
                    v-show="store.selectedPost.comments.length > 0"
                    class="flex gap-2 items-center"
                  >
                    <span>{{ store.selectedPost.comments.length }}</span>
                    <CommentIcon class="h-5 w-auto text-cyan-500" />
                  </div>
                </div>
              </div>
            </button>
            <div class="w-full flex flex-col gap-4 text-sm md:text-base font-medium p-2">
              <form @submit.prevent="comment()" class="flex items-center gap-2">
                <input
                  v-model="newComment"
                  placeholder="Write a comment"
                  class="flex-grow focus:outline-none border-2 border-black border-opacity-20 rounded"
                  type="text"
                  name=""
                  id=""
                />
                <button type="submit"><SendIcon class="lg:size-8 text-cyan-500" /></button>
              </form>
              <div class="h-fit flex flex-col gap-4">
                <CommentsSection />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import CommentsSection from '@/components/CommentsSection.vue'
import SendIcon from '@/components/icons/SendIcon.vue'
import LoadView from '@/components/LoadView.vue'
import UpdatePostPanel from '@/components/UpdatePostPanel.vue'
import CommentIcon from '@/components/icons/CommentIcon.vue'
import ThreeDotsIcon from '@/components/icons/ThreeDotsIcon.vue'
import CommetLogoIcon from '@/components/icons/CommetLogoIcon.vue'
import { useStore } from '@/stores'
import { onBeforeMount, ref } from 'vue'
import { useRoute } from 'vue-router'
import { UseToaster } from '@/stores/toaster'
import router from '@/router'
import { APIService } from '@/services/api'

const store = useStore()
const route = useRoute()
const toaster = UseToaster()

let post = ref(null)
let loading = ref(true)
let showMenu = ref(false)
let newComment = ref('')

const toggleMenu = () => {
  showMenu.value = !showMenu.value
}

const editPost = () => {
  store.setSelectedPost(store.selectedPost)
  store.switchUpdatePanel(true)
  showMenu.value = false
}

const deletePost = async () => {
  let request = await store.deletePost(store.getUserId, post.value.id)

  if (request.ok) {
    showMenu.value = false
    router.push('/')
  } else {
    setTimeout(() => {
      toaster.triggerToast(request.message)
    }, 200)
  }
}

const goTo = (newLocation) => {
  window.location = newLocation
}

const comment = async () => {
  let request = await store.commentPost(store.selectedPost.id, newComment.value)

  if (request.ok) {
    newComment.value = ""
  } else {
    setTimeout(() => {
      toaster.triggerToast(request.message)
    }, 200)
  }
}

onBeforeMount(async () => {
  if (store.selectedPost) {
    post.value = store.selectedPost
    loading.value = false
  } else {
    let request = await store.getPost(route.params.userId, route.params.postId)

    if (request.ok) {
      post.value = store.selectedPost
      loading.value = false
    } else {
      setTimeout(() => {
        toaster.triggerToast(request.message)
      }, 200)
    }
  }
})
</script>
