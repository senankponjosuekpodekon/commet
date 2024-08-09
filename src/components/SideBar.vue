<template>
    <div class="hidden h-full w-16 lg:flex flex-col items-center gap-24">
        <button @click="store.switchCreatePanel(true)" v-if="$route.path === '/'"><AddPostIcon class="h-8 w-auto text-black text-opacity-35" /></button>
        <div v-else></div>
        <div class="w-full flex flex-col items-center gap-4 bg-white py-12 rounded-full">
            <button v-show="$route.path === '/'"><SearchIcon class="h-8 w-auto text-black text-opacity-35" /></button>
            <button><NotificationIcon class="h-8 w-auto text-black text-opacity-35" /></button>
        </div>
    </div>
</template>

<script setup>
import NotificationIcon from './icons/NotificationIcon.vue';
import SearchIcon from './icons/SearchIcon.vue';
import AddPostIcon from './icons/AddPostIcon.vue';
import { useStore } from '@/stores';

const store = useStore();
</script>