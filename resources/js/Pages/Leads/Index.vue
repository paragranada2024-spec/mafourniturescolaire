<template>
  <div class="container mx-auto p-6 bg-gray-50 min-h-screen">
    <h1 class="text-4xl font-extrabold mb-8 text-gray-900 text-center">Items List</h1>

    <div class="flex justify-end mb-6">
      <a
        href="/leads/create"
        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
      >
        <PlusIcon class="w-5 h-5 mr-2" />
        Add New Item
      </a>
    </div>

    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Phone</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
          <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="leads.length === 0">
          <td colspan="4" class="text-center py-12">
            <ClipboardListIcon class="h-16 w-16 text-gray-400 mx-auto mb-4" />
            <p class="text-gray-600 text-lg font-medium">No items found.</p>
            <p class="text-gray-500 mt-2">Click "Add New Item" to get started!</p>
          </td>
        </tr>

        <tr v-for="lead in leads" :key="lead.id" class="hover:bg-gray-50 transition">
          <td class="px-6 py-4 text-gray-800 font-semibold">{{ lead.name }}</td>
          <td class="px-6 py-4 text-gray-800">{{ lead.phon }}</td>
          <td class="px-6 py-4 text-gray-800">{{ lead.email }}</td>
          <td class="px-6 py-4 text-right">
            <button
              @click="editItem(lead.id)"
              class="text-blue-600 hover:text-blue-800 p-2 rounded-md"
              aria-label="Edit"
            >
              <Edit class="w-5 h-5" />
            </button>
            <button
              @click="deleteItem(lead.id)"
              class="text-red-600 hover:text-red-800 p-2 rounded-md"
              aria-label="Delete"
            >
              <Trash2 class="w-5 h-5" />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { Edit, Trash2, ClipboardListIcon, PlusIcon } from 'lucide-vue-next'
import { router } from '@inertiajs/vue3'



defineProps({
  leads: Array,
});

const editItem = (id) => {
  router.get(`/students/${id}/edit`)
};

const deleteItem = (id) => {
  if (confirm(`Are you sure you want to delete item ID: ${id}?`)) {
    router.delete(`/leads/${id}`);
  }
};
</script>
