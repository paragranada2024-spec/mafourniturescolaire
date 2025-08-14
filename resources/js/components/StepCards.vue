<template>
    <div class="bg-white rounded-xl p-5 sm:p-6 shadow-sm border 
             w-[100%] xxs:w-[300px] flex-shrink-0
             md:w-full md:min-w-0 md:flex-shrink
             transition-all">
        <div class="flex justify-center mb-4 sm:mb-6">
            <div class="w-40 h-28 sm:w-52 sm:h-32">
                <img :src="img" alt="Illustration étape" class="w-full h-full object-contain" />
            </div>
        </div>
        <div class="text-center md:text-left">
            <div class="flex items-center justify-center md:justify-start mb-2 sm:mb-3">
                <span class="bg-blue-100 text-blue-800 text-sm sm:text-lg font-bold 
                   w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center 
                   mr-2 sm:mr-3">
                    {{ number }}
                </span>
                <h3 class="text-base sm:text-lg font-semibold">{{ title }}</h3>
            </div>
            <p class="text-gray-600 text-xs sm:text-sm">{{ desc }}</p>
        </div>
    </div>
</template>
<script setup>
defineProps({
    number: {
        type: [String, Number],
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    desc: {
        type: String,
        required: true,
    },
    img: {
        type: String,
        required: true,
    },
})
</script>
