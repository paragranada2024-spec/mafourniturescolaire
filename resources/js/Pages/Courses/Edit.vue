<template>
  <div>
    <h1>Edit Course</h1>
    <form @submit.prevent="submit">
      <input v-model="form.titel" placeholder="Title" />
      <textarea v-model="form.description" placeholder="Description"></textarea>

      <h2>Select Students</h2>
      <div v-for="student in students" :key="student.id">
        <label>
          <input type="checkbox" :value="student.id" v-model="form.students" />
          {{ student.name }}
        </label>
      </div>

      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { defineProps, watch } from 'vue'

const props = defineProps({
  course: Object,
  students: Array,
})

const form = useForm({
  titel: props.course.titel,
  description: props.course.description,
  students: props.course.students.map(s => s.id),
})

const submit = () => {
  form.put(`/courses/${props.course.id}`)
}
</script>
