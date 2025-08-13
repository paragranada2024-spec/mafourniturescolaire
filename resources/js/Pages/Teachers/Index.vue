<template>
  <div class="container mx-auto p-6 bg-gray-50 min-h-screen">
    <h1 class="text-4xl font-extrabold mb-8 text-gray-900 text-center">Teachers List</h1>

    <div class="flex justify-end mb-6">
      <a
        href="/teachers/create"
        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700"
      >
        Add New Teacher
      </a>
    </div>

    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
          <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="teachers.length === 0">
          <td colspan="4" class="text-center py-12 text-gray-500">No Teachers found.</td>
        </tr>

        <tr
          v-for="teacher in teachers"
          :key="teacher.id"
          class="hover:bg-gray-50 transition"
        >
          <td class="px-6 py-4 text-gray-800">{{ teacher.name }}</td>
          <td class="px-6 py-4 text-gray-800">{{ teacher.email }}</td>
          <td class="px-6 py-4 text-right">
            <button
              @click="editTeacher(teacher.id)"
              class="text-blue-600 hover:text-blue-800 px-2"
            >
              Edit
            </button>
            <button
              @click="deleteTeacher(teacher.id)"
              class="text-red-600 hover:text-red-800 px-2"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { usePage, router } from '@inertiajs/vue3'
import { computed } from 'vue'

const teachers = computed(() => usePage().props.teachers || [])

const deleteTeacher = (id) => {
  if (confirm('Are you sure you want to delete this student?')) {
    router.delete(`/teachers/${id}`)
  }
}

const editTeacher = (id) => {
  router.get(`/teachers/${id}/edit`)
}
</script>
