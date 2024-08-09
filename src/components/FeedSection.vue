<template>
    <div class="flex-grow w-full lg:w-1/2 flex flex-col gap-4 mt-4 mb-16 md:mb-24 lg:mb-0">
        <FeedPost v-for="post in feed" :key="post.id" :post="post" />
    </div>
</template>

<script setup>
import FeedPost from './FeedPost.vue';

const props = defineProps({
    feed: Array
})
</script>