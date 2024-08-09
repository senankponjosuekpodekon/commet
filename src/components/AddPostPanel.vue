<template>
  <div
    class="absolute top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50 z-30"
  >
    <div class="relative w-full md:w-2/3 lg:w-1/2 flex flex-col gap-12 bg-white m-4 rounded-md p-4">
      <button @click="closePanel()" class="absolute top-4 right-4 text-black">
        <CrossIcon class="size-8" />
      </button>
      <span class="text-center text-lg md:text-xl font-semibold">Comment something</span>
      <form @submit.prevent="addPost()" class="flex flex-col gap-8">
        <div class="w-full">
          <span class="text-red-500 text-sm font-semibold" v-if="errors.title">{{
            errors.title[0]
          }}</span>
          <input
            placeholder="Enter your title here"
            v-model="title"
            class="w-full bg-gray-50 border-2 border-black border-opacity-20 focus:outline-none rounded"
            type="text"
            name=""
            id=""
          />
        </div>
        <div class="w-full">
          <span class="text-red-500 text-sm font-semibold" v-if="linkError">{{ linkError }}</span>
          <input
            v-model="link"
            placeholder="Resource link"
            class="w-full bg-gray-50 border-2 border-black border-opacity-20 focus:outline-none rounded"
            type="text"
            name=""
            id=""
          />
        </div>
        <div class="w-full">
          <span class="text-red-500 text-sm font-semibold" v-if="errors.content">{{
            errors.content[0]
          }}</span>
          <textarea
            v-model="content"
            placeholder="Description (optional)"
            class="w-full bg-gray-50 border-2 border-black border-opacity-20 focus:outline-none rounded"
            name=""
            id=""
          ></textarea>
        </div>
        <button
          class="w-full bg-cyan-500 text-white font-semibold md:text-lg p-2 mt-8 rounded"
          type="submit"
        >
          Post
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import CrossIcon from './icons/CrossIcon.vue'
import { useStore } from '@/stores'
import { UseToaster } from '@/stores/toaster'

const store = useStore()
const toaster = UseToaster()

let linkIsOk = ref(true)
let title = ref('')
let link = ref('')
let content = ref('')
let linkError = ref(null)
let errors = ref([])

const addPost = async () => {
  linkIsOk.value = true
  const linkState = checkUrL(link.value.trim())
  linkIsOk.value = linkState.ok

  if (linkIsOk.value) {
    const post = {
      title: title.value,
      link: link.value,
      content: content.value
    }

    let request = await store.createPost(store.getUserId, post)

    if (request.ok) {
      errors.value = []
      linkError.value = ''
      title.value = ''
      link.value = ''
      content.value = ''
      store.switchCreatePanel(false)
    } else {
      if (request.errors) errors.value = request.errors
      else {
        setTimeout(() => {
          toaster.triggerToast(request.message)
        }, 200)
      }
    }
    linkError.value = null
  } else {
    linkError.value = linkState.message
  }
}

const closePanel = () => {
  errors.value = []
  linkError.value = ''
  title.value = ''
  link.value = ''
  content.value = ''
  store.switchCreatePanel(false)
}

const checkUrL = (url) => {
  try {
    new URL(url)
    return { ok: true }
  } catch (error) {
    return { ok: false, message: 'You must provide a valid url as link. (Ex: http://...)' }
  }
}
</script>
