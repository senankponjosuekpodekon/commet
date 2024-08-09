<template>
  <span>{{ comment.content }}</span>
  <div class="flex gap-2 text-sm text-cyan-800">
    <button @click="toggleAnswersView()">See answers</button>
    <button @click="toggleReply()">Reply</button>
  </div>
  <form @submit.prevent="replyTo()" v-show="reply" class="flex items-center gap-2" action="">
    <input
      v-model="newComment"
      placeholder="Write a comment"
      class="focus:outline-none border-2 border-black border-opacity-20 rounded text-sm"
      type="text"
      name=""
      id=""
    />
    <button type="submit"><SendIcon class="lg:size-6 text-cyan-500" /></button>
  </form>
  <CommentChildren v-show="showChildren" :children="comment.children" />
</template>

<script setup>
import { ref } from 'vue'
import CommentChildren from './CommentChildren.vue'
import SendIcon from './icons/SendIcon.vue'
import { useStore } from '@/stores'
import { UseToaster } from '@/stores/toaster'

const props = defineProps({
  comment: Object
})

const store = useStore()
const toaster = UseToaster()

let showChildren = ref(false)
let reply = ref(false)
let newComment = ref('')

const toggleAnswersView = () => {
  showChildren.value = !showChildren.value
}

const toggleReply = () => {
  reply.value = !reply.value
}

const replyTo = async () => {
  let request = await store.replyToComment(props.comment.id, newComment.value)

  if (request.ok) {
    newComment.value = ''
  } else {
    setTimeout(() => {
        toaster.triggerToast(request.message)
    }, 200);
  }
}
</script>
