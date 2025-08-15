<template>
    <div class="bg-white rounded-xl px-5 py-3 sm:p-5 shadow-sm border 
             w-[100%] xxs:w-[300px] flex-shrink-0
             md:w-full md:min-w-0 md:flex-shrink
             transition-all">
        <div class="flex justify-center mb-4 sm:mb-6">
            <div class="w-32 h-[100px] sm:w-32 sm:h-[100px]">
                <img :src="img" alt="Illustration étape" class="w-full h-full object-contain" />
            </div>
        </div>
        <div class="text-center">
            <div class="flex items-center justify-center  mb-2 sm:mb-3">
                <span class="bg-blue-100 text-blue-800 text-sm sm:text-base font-bold 
                   w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center 
                   mr-2 sm:mr-3">
                    {{ number }}
                </span>
                <h3 class="text-base sm:text-base font-semibold">{{ title }}</h3>
            </div>
            <p class="text-gray-600 text-xs sm:text-xs">{{ desc }}</p>
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
