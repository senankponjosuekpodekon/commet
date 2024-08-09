<template>
  <div
    v-if="!loading"
    class="flex flex-col gap-2 bg-cyan-700 bg-opacity-10 rounded-sm p-2"
    v-for="comment in store.currentComments"
    key="comment.id"
  >
    <CommentComponent :comment="comment" />
  </div>
</template>

<script setup>
import { useStore } from '@/stores'
import { UseToaster } from '@/stores/toaster'
import { onBeforeMount, ref } from 'vue'
import CommentComponent from './CommentComponent.vue';

const store = useStore()
const toaster = UseToaster()

let loading = ref(true)

onBeforeMount(async () => {
  let request = await store.getPostComments()
  if (request.ok) {
    loading.value = false
  } else {
    setTimeout(() => {
      toaster.triggerToast(request.message)
    }, 200)
  }
})
</script>
