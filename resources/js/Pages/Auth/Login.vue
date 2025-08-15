<script setup>
import Checkbox from '@/components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

// The existing Inertia form
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

// New state for the custom UI
const showPassword = ref(false);

// The `processing` state from Inertia's useForm already handles loading, so we can use that directly.
// const isLoading = ref(false); 

// The validation is also handled by Inertia, so we'll connect the UI to Inertia's form errors.
// const emailError = ref('');
// const passwordError = ref('');

// Updated submit function to fit the new template's event handler
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const handleGoogleSignIn = () => {
    console.log('Google sign in clicked');
    // Here you would add logic to redirect to the Google OAuth route.
    // For example: window.location.href = '/auth/google';
};
</script>

<template>
    <!-- Use GuestLayout to keep the overall structure from Breeze -->
        <Head title="Log in" />
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <!-- Brand Logo/Title -->
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-[#0a2342] dark:text-white mb-2">Stitch AI</h1>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Welcome back! Please enter your details.
                    </p>
                </div>
            </div>
            
            <div class="mt-8 mx-4 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white dark:bg-gray-800 py-8 px-4 shadow-lg rounded-2xl sm:px-10 border border-gray-200 dark:border-gray-700">
                    <!-- Display status message from Inertia -->
                    <div v-if="status" class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email address
                            </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                autocomplete="email"
                                required
                                :class="[
                                    'block w-full px-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0a2342] focus:border-[#0a2342] transition-colors',
                                    form.errors.email ? 'border-red-300 dark:border-red-600' : 'border-gray-300 dark:border-gray-600',
                                    'bg-white dark:bg-gray-700 text-gray-900 dark:text-white'
                                ]"
                                placeholder="Enter your email"
                            />
                            <p v-if="form.errors.email" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ form.errors.email }}</p>
                        </div>
        
                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    v-model="form.password"
                                    :type="showPassword ? 'text' : 'password'"
                                    autocomplete="current-password"
                                    required
                                    :class="[
                                        'block w-full px-3 py-3 pr-10 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0a2342] focus:border-[#0a2342] transition-colors',
                                        form.errors.password ? 'border-red-300 dark:border-red-600' : 'border-gray-300 dark:border-gray-600',
                                        'bg-white dark:bg-gray-700 text-gray-900 dark:text-white'
                                    ]"
                                    placeholder="Enter your password"
                                />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                >
                                    <!-- Using inline SVG for visibility toggle -->
                                    <svg v-if="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg v-else class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                    </svg>
                                </button>
                            </div>
                            <p v-if="form.errors.password" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ form.errors.password }}</p>
                        </div>
        
                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input
                                    id="remember-me"
                                    v-model="form.remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-[#0a2342] focus:ring-[#0a2342] border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700"
                                />
                                <label for="remember-me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Remember me
                                </label>
                            </div>
        
                            <div class="text-sm">
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="font-medium text-[#0a2342] dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors"
                                >
                                    Forgot your password?
                                </Link>
                            </div>
                        </div>
        
                        <!-- Sign In Button -->
                        <div>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-[#0a2342] hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0a2342] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                            >
                                <span v-if="form.processing" class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                                {{ form.processing ? 'Signing in...' : 'Sign in' }}
                            </button>
                        </div>
        
                        <!-- OAuth Divider -->
                        <!-- <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300 dark:border-gray-600" />
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Or continue with</span>
                                </div>
                            </div>
        
                            <div class="mt-6">
                                <button
                                    type="button"
                                    @click="handleGoogleSignIn"
                                    class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors"
                                >
                                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                    </svg>
                                    Continue with Google
                                </button>
                            </div>
                        </div> -->
                    </form>
        
                    <!-- Sign Up Link -->
                    <div class="mt-6">
                        <div class="text-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                Don't have an account?
                                <Link
                                    :href="route('register')"
                                    class="font-medium text-[#0a2342] dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors"
                                >
                                    Sign up
                                </Link>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
