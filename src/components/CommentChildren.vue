<template>
    <div class="flex flex-col gap-2">
        <span class="text-sm" v-for="child in children" :key="child.id">{{ child.content }}</span>
    </div>
</template>

<script setup>


const props = defineProps({
    children: Array
})
</script>