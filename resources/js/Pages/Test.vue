<script setup>
import { ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'

const { commandes = [] } = usePage().props

const form = useForm({
  name: '',
  telephone: '',
  ville: '',
  pack: 'eco', // default value
  files: [],
})

const fileInput = ref(null)

function handleFilesChange(e) {
  const files = Array.from(e.target.files)
  form.files.push(...files)
  e.target.value = null
}

function removeFile(index) {
  form.files.splice(index, 1)
}

function triggerFileSelect() {
  fileInput.value.click()
}

function submit() {
  if(form.files.length === 0){
    alert("Merci de choisir au moins un fichier")
    return
  }

  form.post(route('test.store'), {
    forceFormData: true,
    onSuccess: () => {
      form.reset('name', 'telephone', 'ville', 'pack', 'files')
      form.files.value = []
    }
  })
}

function filePreview(file) {
  if (file.type.startsWith('image/')) {
    return URL.createObjectURL(file)
  } else if (file.type === 'application/pdf') {
    return '/pdf-icon.svg'
  }
  return ''
}
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-100 py-10 px-4">
    <!-- Formulaire client -->
    <form @submit.prevent="submit" enctype="multipart/form-data"
      class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-8 space-y-6 transition-shadow duration-300 hover:shadow-2xl">
      <h1 class="text-2xl font-semibold text-indigo-700 mb-6 text-center">Ajouter une nouvelle commande</h1>

      <!-- Nom -->
      <div>
        <label class="block mb-1 font-medium text-gray-700">Nom</label>
        <input v-model="form.name" type="text" placeholder="Entrez le nom"
          class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
        <p v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</p>
      </div>

      <!-- Téléphone -->
      <div>
        <label class="block mb-1 font-medium text-gray-700">Téléphone</label>
        <input v-model="form.telephone" type="tel" placeholder="Entrez le téléphone"
          class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
        <p v-if="form.errors.telephone" class="text-red-600 text-sm mt-1">{{ form.errors.telephone }}</p>
      </div>

      <!-- Ville -->
      <div>
        <label class="block mb-1 font-medium text-gray-700">Ville</label>
        <input v-model="form.ville" type="text" placeholder="Entrez la ville"
          class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
        <p v-if="form.errors.ville" class="text-red-600 text-sm mt-1">{{ form.errors.ville }}</p>
      </div>

      <!-- Pack -->
      <div>
        <label class="block mb-1 font-medium text-gray-700">Pack</label>
        <select v-model="form.pack"
          class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
          <option value="eco">Eco</option>
          <option value="plus">Plus</option>
        </select>
        <p v-if="form.errors.pack" class="text-red-600 text-sm mt-1">{{ form.errors.pack }}</p>
      </div>

      <!-- Fichiers -->
      <div>
        <label class="block mb-1 font-medium text-gray-700">Ajouter des fichiers (images ou PDF)</label>
        <input ref="fileInput" type="file" multiple class="hidden" @change="handleFilesChange" />
        <div class="flex flex-wrap gap-3">
          <button type="button" @click="triggerFileSelect"
            class="w-20 h-20 border border-dashed border-indigo-400 rounded-md flex justify-center items-center text-indigo-400 text-3xl font-bold hover:bg-indigo-100 transition">
            +
          </button>

          <template v-for="(file, index) in form.files" :key="index">
            <div class="relative w-20 h-20 rounded-md overflow-hidden border shadow-sm">
              <button @click.prevent="removeFile(index)"
                class="absolute top-0 right-0 bg-red-600 text-white rounded-bl-md px-1.5 py-0.5 text-xs z-10 hover:bg-red-700">x</button>
              <img v-if="file.type.startsWith('image/')" :src="filePreview(file)" alt="Preview" class="object-cover w-full h-full" />
              <img v-else-if="file.type === 'application/pdf'" src="/pdf-icon.svg" alt="PDF" class="object-contain w-full h-full p-2" />
              <div v-else class="flex items-center justify-center w-full h-full text-gray-500 text-xs px-1 text-center">
                {{ file.name }}
              </div>
            </div>
          </template>
        </div>
        <p v-if="form.errors.files" class="text-red-600 text-sm mt-1">{{ form.errors.files }}</p>
      </div>

      <button type="submit"
        class="w-full bg-indigo-600 text-white py-3 rounded-md font-semibold hover:bg-indigo-700 transition"
        :disabled="form.processing">
        Envoyer
      </button>
    </form>

    <!-- Commandes affichées -->
    <section class="max-w-lg mx-auto mt-12">
      <h2 class="text-xl font-semibold text-indigo-700 mb-4">Commandes enregistrées</h2>
      <ul>
        <li v-for="cmd in commandes" :key="cmd.id"
          class="bg-white rounded-md p-4 mb-4 shadow-md hover:shadow-lg transition-shadow">
          <p><span class="font-semibold">Nom :</span> {{ cmd.name }}</p>
          <p><span class="font-semibold">Téléphone :</span> {{ cmd.telephone }}</p>
          <p><span class="font-semibold">Ville :</span> {{ cmd.ville }}</p>
          <p><span class="font-semibold">Pack :</span> {{ cmd.pack }}</p>
          <div v-if="cmd.items && cmd.items.length" class="mt-3">
            <p class="font-semibold mb-2">Fichiers :</p>
            <ul class="list-disc list-inside space-y-1">
              <li v-for="item in cmd.items" :key="item.id">
                <a :href="`/storage/${item.image}`" target="_blank" class="text-indigo-600 hover:underline">
                  Voir le fichier
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </section>
  </div>
</template>
