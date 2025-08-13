<template>
  <div class="max-w-xl mx-auto p-8 bg-white shadow-md mt-10 rounded">
    <h1 class="text-2xl font-bold mb-6 text-center">Edit Teacher</h1>

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
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
  teacher: Object,
})

const form = useForm({
  name: props.teacher.name,
  email: props.teacher.email,
})

const submit = () => {
  form.put(`/teachers/${props.teacher.id}`, {
    onSuccess: () => {
      window.location.href = '/teachers'
    }
  })
}
</script>
