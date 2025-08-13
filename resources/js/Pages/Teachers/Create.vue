<template>
  <div class="max-w-xl mx-auto p-8 bg-white shadow-md  rounded mt-24">
    <h1 class="text-2xl font-bold mb-6 text-center">ADD New Teacher</h1>
    
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block text-gray-700">Name</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-4 py-2 mt-1" />
        <span class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</span>
      </div>
        <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input v-model="form.email" type="email" class="w-full border rounded px-4 py-2 mt-1" />
        <span class="text-red-500 text-sm" v-if="form.errors.email">{{ form.errors.email }}</span>
      </div>
     
      <div class="flex flex-col items-center gap-2">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">Save</button>
      <button  type="button"
      @click="goBackToLead"
            class="  text-sm text-indigo-600 hover:underline font-medium ">⬅️ Retour aux List</button>
            </div>
          </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
})

const submit = () => {
  form.post('/teachers')
}
const goBackToLead=()=>{
window.location.href = '/teachers';
}
</script>
