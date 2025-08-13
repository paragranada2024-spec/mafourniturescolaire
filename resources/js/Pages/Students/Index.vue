<template>
  <div class="container mx-auto p-6 bg-gray-50 min-h-screen">
    <h1 class="text-4xl font-extrabold mb-8 text-gray-900 text-center">Students List</h1>

    <div class="flex justify-end mb-6">
      <a
        href="/students/create"
        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700"
      >
        Add New Student
      </a>
    </div>

    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Note</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Courses</th>
          <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="students.length === 0">
          <td colspan="5" class="text-center py-12 text-gray-500">No students found.</td>
        </tr>

        <tr v-for="student in students" :key="student.id" class="hover:bg-gray-50 transition">
          <td class="px-6 py-4 text-gray-800">{{ student.name }}</td>
          <td class="px-6 py-4 text-gray-800">{{ student.email }}</td>
          <td class="px-6 py-4 text-gray-800">{{ student.note }}</td>
          <td class="px-6 py-4 text-gray-800">
            <ul class="list-disc ml-4">
              <li v-for="course in student.courses" :key="course.id">
                <span class="font-semibold">      {{ course.titel.trim() }} </span>
              </li>
            </ul>
          </td>
          <td class="px-6 py-4 text-right">
            <button
              @click="editStudent(student.id)"
              class="text-blue-600 hover:text-blue-800 px-2"
            >
              Edit
            </button>
            <button
              @click="deleteStudent(student.id)"
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

// students data from props
const students = computed(() => usePage().props.students || [])

const deleteStudent = (id) => {
  if (confirm('Are you sure you want to delete this student?')) {
    router.delete(`/students/${id}`)
  }
}

const editStudent = (id) => {
  router.get(`/students/${id}/edit`)
}
</script>
