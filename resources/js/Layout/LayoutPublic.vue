<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <AppNavigation />
    <main>
      <slot />
    </main>
    <AppFooter />
  </div>
</template>

<script setup>
import AppNavigation from '../components/Layout/AppNavigation.vue'
import AppFooter from '../components/Layout/AppFooter.vue'
</script>