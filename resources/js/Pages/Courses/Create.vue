<template>
  <div class="max-w-xl mx-auto p-8 bg-white shadow-md rounded mt-24">
    <h1 class="text-2xl font-bold mb-6 text-center">Add New Student</h1>

    <form @submit.prevent="submit">
      <!-- Name -->
      <div class="mb-4">
        <label class="block text-gray-700">Name</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-4 py-2 mt-1" />
        <span class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</span>
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input v-model="form.email" type="email" class="w-full border rounded px-4 py-2 mt-1" />
        <span class="text-red-500 text-sm" v-if="form.errors.email">{{ form.errors.email }}</span>
      </div>

      <!-- Note -->
      <div class="mb-4">
        <label class="block text-gray-700">Note</label>
        <input
          v-model.number="form.note"
          type="number"
          class="w-full border rounded px-4 py-2 mt-1"
        />
        <span class="text-red-500 text-sm" v-if="form.errors.note">{{ form.errors.note }}</span>
      </div>

      <!-- Course Title -->
      <div class="mb-4">
        <label class="block text-gray-700">Course Title</label>
        <input
          v-model="form.title"
          type="text"
          placeholder="Enter course title"
          class="w-full border rounded px-4 py-2 mt-1"
        />
        <span class="text-red-500 text-sm" v-if="form.errors.course_title">{{ form.errors.course_title }}</span>
      </div>

      <!-- Course Description -->
      <div class="mb-4">
        <label class="block text-gray-700">Course Description</label>
        <textarea
          v-model="form.description"
          placeholder="Enter course description"
          class="w-full border rounded px-4 py-2 mt-1"
        ></textarea>
        <span class="text-red-500 text-sm" v-if="form.errors.course_description">{{ form.errors.course_description }}</span>
      </div>

      <!-- Buttons -->
      <div class="flex justify-center gap-4">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
          Save
        </button>
        <button type="button" @click="goBack" class="text-indigo-600 hover:underline px-6 py-2">
          Cancel
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const form = ref({
  name: '',
  email: '',
  note: '',
  title: '',
  description: '',
})

const submit = () => {
  router.post('/courses', form.value) 
}

const goBack = () => {
  router.get('/courses')
}
</script>
