<template>
  <div class="min-h-screen bg-gray-50 pb-20 pt-6 background1 md:background">
    <!-- Contenu principal -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <!-- Titre et sous-titre -->
      <div class="text-center mb-8 sm:mb-12 pt-6">
        <h1 class="text-xl sm:text-3xl font-bold text-gray-900 mb-3 sm:mb-4 leading-tight">
          Nous préparons votre liste scolaire
        </h1>
        <p class="text-sm text-gray-600">
          Liste scolaire préparée avec soin et livrée chez vous, au prix le plus bas.
        </p>
      </div>

      <!-- Les 3 étapes -->
      <div class="relative mb-10 md:mb-12">
        <!-- Mobile: carrousel horizontal avec snap -->
        <div class="flex flex-wrap md:hidden gap-3 " aria-label="Étapes">
          <StepCards number="1" title="J'importe mes listes de fournitures."
            desc="Je peux renseigner les options et les préférences de mon enfant" img="/storage/svg1.svg" class="" />
          <StepCards number="2" title="Validation rapide"
            desc="Nous vous contactons pour vous communiquer le prix et confirmer votre liste." img="/storage/svg2.svg"
            class="" />
          <StepCards number="3" title="Livraison rapide" desc="Vos fournitures arrivent chez vous dans les 48h."
            img="/storage/svg3.svg" class="" />
        </div>

        <!-- Desktop: grille -->
        <div class="hidden md:grid md:grid-cols-3 md:gap-6">
          <StepCards number="1" title="J'importe mes listes de fournitures."
            desc="Je peux renseigner les options et les préférences de mon enfant" img="/storage/svg1.svg" class="" />
          <StepCards number="2" title="Validation rapide"
            desc="Nous vous contactons pour vous communiquer le prix et confirmer votre liste." img="/storage/svg2.svg"
            class="" />
          <StepCards number="3" title="Livraison rapide" desc="Vos fournitures arrivent chez vous dans les 48h."
            img="/storage/svg3.svg" class="" />
        </div>
      </div>

      <!-- Message d'information -->
      <div class="text-center mb-6 sm:mb-8 px-2">
        <p class="text-xs sm:text-sm text-red-600" style="font-style: italic;">
          Les manuels scolaires ne sont pas pris en charge, uniquement les fournitures.
        </p>
      </div>

      <!-- Section d'ajout de fichiers -->
      <div class="mx-auto mb-8 bg-white rounded-xl shadow-sm border p-4 sm:p-6">
        <div class="flex items-center justify-between gap-3 mb-4">
          <h3 class="text-base sm:text-lg font-semibold text-gray-900">Ajouter vos fichiers</h3>
          <p class="text-[11px] sm:text-xs text-gray-500">Formats: JPG, PNG, PDF</p>
        </div>

        <div class="space-y-4">
          <div class="flex flex-wrap items-start gap-3">
            <button type="button" @click="triggerFileSelect"
              class="shrink-0 w-20 h-20 sm:w-24 sm:h-24 border-2 border-dashed border-indigo-300 rounded-lg flex justify-center items-center text-indigo-500 text-3xl font-bold hover:bg-indigo-50 active:scale-[0.98] transition"
              aria-label="Ajouter des fichiers">
              +
            </button>
            <input ref="fileInput" type="file" multiple accept=".jpg,.jpeg,.png,.pdf" @change="handleFileUpload"
              class="hidden" />

            <!-- Previews -->
            <div v-for="(file, index) in form.files" :key="index"
              class="relative w-20 h-20 sm:w-24 sm:h-24 rounded-lg overflow-hidden border bg-white shadow-sm">
              <button @click.prevent="removeFile(index)"
                class="absolute top-0 right-0 bg-red-600 text-white rounded-bl-md px-1.5 py-0.5 text-[10px] z-10 hover:bg-red-700"
                aria-label="Supprimer le fichier">
                ×
              </button>

              <img v-if="file.type?.startsWith('image/')" :src="filePreview(file)" alt="Aperçu"
                class="object-cover w-full h-full" />

              <div v-else-if="file.type === 'application/pdf'"
                class="flex flex-col items-center justify-center w-full h-full p-2 text-center">
                <img src="/pdf-icon.svg" alt="PDF" class="w-8 h-8 mb-1" />
                <span class="text-[10px] text-gray-600 line-clamp-2">{{ file.name }}</span>
              </div>

              <div v-else
                class="flex items-center justify-center w-full h-full text-gray-500 text-[10px] px-1 text-center">
                {{ file.name }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Section Pack Options (compact & clean) -->
      <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 my-4">
        <li v-for="option in options" :key="option.value">
          <!-- Radio (hidden) -->
          <input class="peer sr-only" type="radio" :id="`pack-${option.value}`" :value="option.value"
            v-model="form.pack" @change="changeDelivery(option.value)" />

          <!-- Card -->
          <label :for="`pack-${option.value}`" class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer transition-colors
             border-gray-200 hover:border-gray-300
             peer-checked:border-pink-500 peer-checked:bg-pink-50">
            <!-- Icon -->
            <span class="flex-none w-8 h-8 rounded-full flex items-center justify-center
               bg-gray-100 text-gray-500
               peer-checked:bg-pink-100 peer-checked:text-pink-600">
              <svg v-if="option.value === 'plus'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </span>

            <!-- Text -->
            <div class="min-w-0">
              <p class="text-sm font-medium text-gray-900">
                {{ option.label }}
              </p>
              <p class="text-xs text-gray-500 leading-snug">
                {{ option.desc }}
              </p>
            </div>
          </label>
        </li>
      </ul>


      <!-- <ul class="grid md:grid-cols-2 gap-4">
        <li v-for="option in options" :key="option.value">
          <label :for="option.value" @click="changeDelivery(option.value)"
            class="flex items-start gap-4 p-4 border rounded-lg cursor-pointer transition hover:border-pink-600"
            :class="{ 'border-pink-600 bg-pink-50': form.pack === option.value }">
            <input type="radio" :id="option.value" :value="option.value" v-model="form.pack"
              class="mt-1 accent-pink-600" />
            <div>
              <p class="font-semibold">{{ option.label }}</p>
            </div>
          </label>
        </li>
      </ul> -->
      <!-- Formulaire d'informations -->
      <div class="bg-white rounded-xl border p-4 sm:p-6 shadow-sm">
        <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 sm:mb-6">Vos informations</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
          <div>
            <label for="nom" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Nom *</label>
            <input id="nom" v-model="form.name" type="text" required autocomplete="name"
              class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
              placeholder="Votre nom" />
          </div>

          <div>
            <label for="telephone" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Téléphone *</label>
            <input id="telephone" v-model="form.telephone" type="tel" inputmode="tel" required
              class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
              placeholder="Votre numéro de téléphone" />
          </div>

          <div class="">
            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Ville</label>
            <select v-model="form.ville"
              class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
              <option value="">-- Sélectionnez une ville --</option>
              <option v-for="ville in villes" :key="ville" :value="ville">
                {{ ville }}
              </option>
            </select>
          </div>
        </div>

        <div class="mt-6 sm:mt-8 flex justify-center">
          <button @click="submit" :disabled="!isFormValid"
            class="w-full md:w-auto bg-green-600 hover:bg-green-700 disabled:bg-gray-300 disabled:text-gray-600 disabled:cursor-not-allowed text-white px-5 sm:px-8 py-3 rounded-lg font-medium transition-colors">
            Commander
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onBeforeUnmount } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import StepCards from '@/components/StepCards.vue'

const { commandes = [] } = usePage().props

const form = useForm({
  name: '',
  telephone: '',
  ville: '',
  pack: 'eco', // default value
  files: [],
})
const villes = [
  "Agadir", "Ahfir", "Aïn Harrouda", "Aït Melloul", "Al Hoceima", "Arfoud", "Asilah", "Azemmour",
  "Azilal", "Azzour", "Beni Ansar", "Beni Mellal", "Ben Guerir", "Berkane", "Berrechid", "Bouarfa",
  "Boujdour", "Bouskoura", "Casablanca", "Chefchaouen", "Dakhla", "Dcheira El Jihadia", "Demnate",
  "El Hajeb", "El Jadida", "El Kelaa des Sraghna", "Erfoud", "Errachidia", "Essaouira", "Fès",
  "Figuig", "Fnideq", "Guelmim", "Guercif", "Ifrane", "Inezgane", "Jerada", "Kénitra", "Khemisset",
  "Khenifra", "Khouribga", "Ksar El Kebir", "Laâyoune", "Larache", "Marrakech", "Martil", "Meknès",
  "Midelt", "Mohammédia", "Mohammedia", "Nador", "Ouarzazate", "Oujda", "Oulad Teima", "Rabat",
  "Safi", "Salé", "Sefrou", "Settat", "Sidi Bennour", "Sidi Ifni", "Sidi Kacem", "Sidi Slimane",
  "Skhirat", "Smara", "Souk Sebt", "Tahala", "Tahla", "Tan-Tan", "Tanger", "Tetouan", "Taourirt", "Taroudant",
  "Taza", "Temara", "Tiflet", "Tinghir", "Tiznit", "Témara", "Youssoufia", "Zagora"
]
const objectUrls = new Map()


const options = computed(() => [
  {
    value: 'plus',
    label: 'Pack Plus',
    desc: 'Tout le nécessaire avec des fournitures de qualité supérieure.'
  },
  {
    value: 'eco',
    label: 'Pack Éco',
    desc: 'L’essentiel au meilleur prix, tout en restant fonctionnel.'
  }
])



function handleFileUpload(e) {
  const files = Array.from(e.target.files).filter(f => f instanceof File)
  form.files.push(...files)
  e.target.value = null
}
function removeFile(index) {
  const f = form.files[index]
  if (f && objectUrls.has(f)) {
    URL.revokeObjectURL(objectUrls.get(f))
    objectUrls.delete(f)
  }
  form.files.splice(index, 1)
}

const fileInput = ref(null)
function triggerFileSelect() {
  fileInput.value?.click()
}

function changeDelivery(type) {
  const option = options.value.find(opt => opt.value === type)
  if (!option) return
  form.pack = type
}

function submit() {
  if (form.files.length === 0) {
    alert('Merci de choisir au moins un fichier')
    return
  }
  console.log(form);

  form.post(route('home.store'), {
    forceFormData: true,
    onSuccess: () => {
      // Réinitialiser
      form.reset('name', 'telephone', 'ville', 'pack')
      // Révoquer les URLs créées
      for (const [file, url] of objectUrls.entries()) {
        URL.revokeObjectURL(url)
      }
      objectUrls.clear()
      form.files = []
      if (fileInput.value) fileInput.value.value = ''
    },
  })
}

function filePreview(file) {
  if (!file) return ''
  if (file.type?.startsWith('image/')) {
    if (!objectUrls.has(file)) {
      objectUrls.set(file, URL.createObjectURL(file))
    }
    return objectUrls.get(file)
  } else if (file.type === 'application/pdf') {
    return '/pdf-icon.svg'
  }
  return ''
}

onBeforeUnmount(() => {
  for (const [, url] of objectUrls) URL.revokeObjectURL(url)
  objectUrls.clear()
})

// Validation du formulaire
const isFormValid = computed(() => {
  return (
    form.name.trim() !== '' &&
    form.telephone.trim() !== '' &&
    form.ville.trim() !== ''
  )
})

// Utilitaire format taille (si besoin dans le futur)
const formatFileSize = (bytes) => {
  if (bytes === 0) return '0 Bytes'
  const k = 1024
  const sizes = ['Bytes', 'KB', 'MB', 'GB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}
</script>



<style>
/**** Optionnel : césure douce sur petits écrans ****/
@media (max-width: 360px) {
  h1 {
    word-break: break-word;
  }
}

.background {
  background-image: url('/storage/Design sans titre.jpg');
  background-size: contain;
  /* ما يقطعش الصورة */
  background-position: top center;
  /* يبقيها من الفوق */
  background-repeat: no-repeat;

  width: 100%;
  min-height: 100vh;
  background-color: #f8f8f8;
  /* لون فراغ تحت/جنب الصورة */
}

.background1 {
  background-image: url('/storage/Design sans titre (1).jpg');
  background-size: cover;
  /* ما يقطعش الصورة */
  background-position: top center;
  /* يبقيها من الفوق */
  background-repeat: no-repeat;

  width: 100%;
  min-height: 100vh;
  background-color: #f8f8f8;
  /* لون فراغ تحت/جنب الصورة */
}
</style>
