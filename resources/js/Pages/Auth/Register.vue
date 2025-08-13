<script setup>
// This is your original script block, preserved as requested.
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <!-- Use the original GuestLayout wrapper for consistency -->
        <Head title="Register" />

        <!-- New styled container from your second example -->
        <div class="sm:mx-auto mt-4 sm:w-full sm:max-w-md">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-[#0a2342] dark:text-white mb-2">Stitch AI</h1>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Create your account</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Join thousands of users already using Stitch AI.
                </p>
            </div>
        </div>

        <div class="mt-8 mx-4 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white dark:bg-gray-800 py-8 px-4 shadow-lg rounded-2xl sm:px-10 border border-gray-200 dark:border-gray-700">
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Name Field -->
                    <div>
                        <InputLabel for="name" value="Full name" class="mb-2" />
                        <TextInput
                            id="name"
                            type="text"
                            class="block w-full px-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0a2342] focus:border-[#0a2342] transition-colors bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            :class="{'border-red-300 dark:border-red-600': form.errors.name}"
                        />
                        <InputError class="mt-1" :message="form.errors.name" />
                    </div>

                    <!-- Email Field -->
                    <div>
                        <InputLabel for="email" value="Email address" class="mb-2" />
                        <TextInput
                            id="email"
                            type="email"
                            class="block w-full px-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0a2342] focus:border-[#0a2342] transition-colors bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            :class="{'border-red-300 dark:border-red-600': form.errors.email}"
                        />
                        <InputError class="mt-1" :message="form.errors.email" />
                    </div>

                    <!-- Password Field -->
                    <div>
                        <InputLabel for="password" value="Password" class="mb-2" />
                        <TextInput
                            id="password"
                            type="password"
                            class="block w-full px-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0a2342] focus:border-[#0a2342] transition-colors bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                            :class="{'border-red-300 dark:border-red-600': form.errors.password}"
                        />
                        <InputError class="mt-1" :message="form.errors.password" />
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <InputLabel for="password_confirmation" value="Confirm password" class="mb-2" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="block w-full px-3 py-3 border rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0a2342] focus:border-[#0a2342] transition-colors bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                            :class="{'border-red-300 dark:border-red-600': form.errors.password_confirmation}"
                        />
                        <InputError class="mt-1" :message="form.errors.password_confirmation" />
                    </div>

                    <!-- Note: The original script doesn't have a terms checkbox, so this is added as a placeholder -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                id="terms"
                                name="terms"
                                type="checkbox"
                                required
                                class="h-4 w-4 text-[#0a2342] focus:ring-[#0a2342] border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700"
                            />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-700 dark:text-gray-300">
                                I agree to the 
                                <a href="#" class="font-medium text-[#0a2342] dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                    Terms of Service
                                </a>
                                and 
                                <a href="#" class="font-medium text-[#0a2342] dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                    Privacy Policy
                                </a>
                            </label>
                        </div>
                    </div>

                    <!-- Sign Up Button -->
                    <div>
                        <PrimaryButton
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-[#0a2342] hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0a2342] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing" class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                            {{ form.processing ? 'Creating account...' : 'Create account' }}
                        </PrimaryButton>
                    </div>

                    <!-- OAuth Divider and Google Button -->
                    <div class="mt-6">
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
                    </div>
                </form>

                <!-- Sign In Link -->
                <div class="mt-6">
                    <div class="text-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            Already have an account?
                            <Link :href="route('login')" class="font-medium text-[#0a2342] dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                Sign in
                            </Link>
                        </span>
                    </div>
                </div>
            </div>
        </div>
</template>
