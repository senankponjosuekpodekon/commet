<script setup>
import SideBar from './components/SideBar.vue'
import BottomBar from './components/BottomBar.vue'
import Header from './components/Header.vue'
import Toast from './components/Toast.vue'
import { RouterView } from 'vue-router'

const exceptedPaths = ['/login', '/register']
</script>

<template>
  <Toast />
  <Header v-if="!exceptedPaths.includes($route.path)" class="fixed top-0 left-0" />
  <RouterView />
  <BottomBar v-if="!exceptedPaths.includes($route.path)" class="fixed bottom-0 left-0" />
  <SideBar v-if="!exceptedPaths.includes($route.path)" class="fixed top-[80%] left-16 translate-y-[-50%] h-2/5" />
</template>
