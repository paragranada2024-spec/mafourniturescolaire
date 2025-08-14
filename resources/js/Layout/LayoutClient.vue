<template>
  <div class="min-h-screen bg-gray-50 flex">
    <!-- Sidebar -->
    <aside
      :class="[
        'fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-50 transition-transform duration-300 ease-in-out',
        sidebarOpen ? 'translate-x-0' : '-translate-x-full'
      ]"
    >
      <!-- Sidebar Header -->
      <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
        <button
          @click="sidebarOpen = false"
          class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
          aria-label="Close sidebar"
        >
          <X class="w-6 h-6" />
        </button>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 px-4 py-6">
        <Link
          href="/admin/commandes"
          class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200"
          :class="isActiveRoute('/commandes') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'"
          @click="closeMobileSidebar"
        >
          <FileText class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
          Commandes
        </Link>
      </nav>
    </aside>

    <!-- Main content -->
    <div
      :class="[
        'flex-1 flex flex-col min-h-screen transition-all duration-300',
        sidebarOpen ? 'pl-64' : 'pl-0'
      ]"
    >
      <!-- Header -->
      <header
        class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30 flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8"
      >
        <!-- Sidebar toggle button -->
        <button
          v-if="!sidebarOpen"
          @click="sidebarOpen = true"
          class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
          aria-label="Open sidebar"
        >
          ☰
        </button>

        <!-- Right side: logout button -->
        <div class="ml-auto">
          <button
            @click="logout"
            class="flex items-center space-x-1 p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
          >
            <LogOut class="w-5 h-5" />
            <span class="text-sm hidden sm:inline">Logout</span>
          </button>
        </div>
      </header>

      <!-- Main slot content -->
      <main class="flex-1 m-10">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'
import { X, FileText, LogOut } from 'lucide-vue-next'

const sidebarOpen = ref(false)

const closeMobileSidebar = () => {
  sidebarOpen.value = false
}

const isActiveRoute = (href) => {
  const page = usePage()
  return page.url === href
}

// Redirect to login on logout
const logout = () => {
    router.post(route('logout'))
}

</script>
