<template>
  <main class="h-full">
    <AddPostPanel v-if="store.showCreatePanel" />
    <UpdatePostPanel v-if="store.showUpdatePanel" />
    <LoadView v-if="loading" />
    <div v-else class="h-full w-full bg-opacity-50 p-2 lg:p-0 md:p-4 pb-4 lg:pb-16">
      <div class="h-full lg:flex lg:gap-4 lg:bg-cyan-100 lg:m-8 lg:pl-24 rounded-b-[35px]">
        <div class="hidden lg:block flex-grow p-2 lg:rounded-b-[35px]"></div>
        <div
          id="lg-scrollable"
          class="h-full lg:overflow-y-auto w-full lg:w-full flex flex-col md:gap-2 bg-cyan-100 bg-opacity-50 p-2 lg:pt-24 md:p-4 mt-20 md:mt-24 lg:mt-0 rounded-b-[25px] lg:rounded-none lg:rounded-br-[35px]"
        >
          <TrendingPostsSection :trending="store.trending" />
          <div>
            <FeedSection :feed="store.feed" />
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import UpdatePostPanel from '@/components/UpdatePostPanel.vue'
import AddPostPanel from '@/components/AddPostPanel.vue'
import FeedSection from '@/components/FeedSection.vue'
import TrendingPostsSection from '@/components/TrendingPostsSection.vue'
import LoadView from '@/components/LoadView.vue'
import { onBeforeMount, ref } from 'vue'
import { useStore } from '@/stores'

const store = useStore()

let loading = ref(true)

onBeforeMount(async () => {
  await store.getFeed()
  await store.getTrendingPosts()
  loading.value = false
})
</script>
