<template>
  <div class="max-w-2xl mx-auto p-8 bg-white shadow-md rounded mt-24">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Lead</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block text-gray-700 font-semibold">Name</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-4 py-2 mt-1" />
        <span class="text-red-600 text-sm" v-if="form.errors.name">{{ form.errors.name }}</span>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-semibold">Phone</label>
        <input v-model="form.phone" type="text" class="w-full border rounded px-4 py-2 mt-1" />
        <span class="text-red-600 text-sm" v-if="form.errors.phone">{{ form.errors.phone }}</span>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 font-semibold">Email</label>
        <input v-model="form.email" type="email" class="w-full border rounded px-4 py-2 mt-1" />
        <span class="text-red-600 text-sm" v-if="form.errors.email">{{ form.errors.email }}</span>
      </div>

      <div class="flex justify-center">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
          Save
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'
    

const props = defineProps({
  lead: Object,
})

// initialize form
const form = useForm({
  name: props.lead.name,
  phone: props.lead.phon,
  email: props.lead.email,
  
}   
)

// submit logic
const submit = () => {
  form.put(`/leads/${props.lead.id}`)
  onsuccess:()=>{
    router.visit('/leads')
  }
}

</script>
