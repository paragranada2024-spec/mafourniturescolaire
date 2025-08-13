<template>
  <div class="max-w-xl mx-auto p-8 bg-white shadow-md mt-10 rounded">
    <h1 class="text-2xl font-bold mb-6 text-center">Edit Student</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block text-gray-700">Name</label>
        <input v-model="form.name" type="text" class="w-full border px-4 py-2 rounded mt-1" />
        <span class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</span>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input v-model="form.email" type="email" class="w-full border px-4 py-2 rounded mt-1" />
        <span class="text-red-500 text-sm" v-if="form.errors.email">{{ form.errors.email }}</span>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700">Note</label>
        <input v-model="form.note" type="text" class="w-full border px-4 py-2 rounded mt-1" />
        <span class="text-red-500 text-sm" v-if="form.errors.note">{{ form.errors.note }}</span>
      </div>
        <div class="mb-4">
  <label class="block text-gray-700">Select Course</label>
  <select
    v-model="form.course_id"
    class="w-full border rounded px-4 py-2 mt-1"
  >
    <option value="" disabled>Select a course</option>
    <option v-for="course in courses" :key="course.id" :value="course.id">
      {{ course.titel }} 
    </option>
  </select>
  <span class="text-red-500 text-sm" v-if="form.errors.course_id">{{ form.errors.course_id }}</span>

</div>  

      <div class="flex justify-center">
        <button
          type="submit"
          class="bg-blue-600 text-white  px-6 py-2 rounded hover:bg-blue-700 "
        >
          Update
        </button>
      </div>
    </form>
  </div>
</template>
<script setup>
import { useForm, usePage, router } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const student = page.props.student
const courses = computed(() => page.props.courses || [])

const form = useForm({
  name: student.name,
  email: student.email,
  note: student.note,
  course_id: student.courses[0]?.id || '',
})

const submit = () => {
  form.put(`/students/${student.id}`)
}
</script>

