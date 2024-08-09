<template>
  <header class="w-full flex justify-between items-center bg-white p-4 lg:px-8 z-20">
    <div class="lg:max-h-10 w-1/2 lg:w-fit flex justify-between items-center">
      <a href="/"><CommetIcon class="lg:hidden h-12 md:h-16 w-auto" /></a>
      <a href="/"><CommetLogoIcon class="hidden lg:block h-32 w-auto" /></a>
      <span
        class="lg:hidden translate-x-[50%] text-lg md:text-2xl text-black text-opacity-40 font-semibold"
        >COMMET</span
      >
    </div>
    <div class="lg:hidden flex items-center gap-3">
      <button><NotificationIcon class="h-6 md:h-8 w-auto text-black text-opacity-50" /></button>
      <button><UserIcon class="h-6 md:h-8 w-auto text-black text-opacity-50" /></button>
      <button @click="logout()"><LogoutIcon class="h-6 md:h-8 w-auto text-black text-opacity-50" /></button>
    </div>
    <div class="absolute left-[50%] translate-x-[-50%] hidden lg:flex gap-24">
      <RouterLink
        to="/"
        class="text-black text-opacity-50"
        active-class="text-cyan-500 text-opacity-[1] px-1 pb-2 border-b-2 border-cyan-500"
        ><HomeIcon class="h-6 md:h-8 lg:h-6 w-auto"
      /></RouterLink>
      <RouterLink
        class="text-black text-opacity-50"
        active-class="text-cyan-500 text-opacity-[1] px-1 pb-2 border-b-2 border-cyan-500"
        to="/login"
        ><UserIcon class="h-6 md:h-8 lg:h-6 w-auto"
      /></RouterLink>
      <RouterLink
        class="text-black text-opacity-50"
        active-class="text-cyan-500 text-opacity-[1] px-1 pb-2 border-b-2 border-cyan-500"
        to="/login"
        ><FollowsIcon class="h-6 md:h-8 lg:h-6 w-auto"
      /></RouterLink>
    </div>
    <button @click="logout()" class="hidden lg:flex items-center gap-2 font-semibold text-black text-opacity-50 hover:text-opacity-100"><span>Logout</span><LogoutIcon class="h-6 md:h-8 w-auto" /></button>
  </header>
</template>

<script setup>
import LogoutIcon from './icons/LogoutIcon.vue'
import FollowsIcon from './icons/FollowsIcon.vue'
import HomeIcon from './icons/HomeIcon.vue'
import NotificationIcon from './icons/NotificationIcon.vue'
import UserIcon from './icons/UserIcon.vue'
import CommetLogoIcon from './icons/CommetLogoIcon.vue'
import CommetIcon from './icons/CommetIcon.vue'
import { RouterLink } from 'vue-router'
import { AuthService } from '@/services/auth'
import { UseToaster } from '@/stores/toaster'
import router from '@/router'

const toaster = UseToaster()

const logout = async () => {
  let response = await AuthService.logout()

  if (response.ok) {
    localStorage.removeItem('userData')
    router.push('/login')
  } else {
    setTimeout(() => {
      toaster.triggerToast(response.message)
    }, 200)
  }
}
</script>
