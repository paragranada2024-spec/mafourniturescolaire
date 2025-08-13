<script setup>
// MainLayout.vue

import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import LayoutAdmin from './LayoutAdmin.vue';
import LayoutClient from './LayoutClient.vue';

// The usePage hook provides access to the shared Inertia page props.
const page = usePage();

// We create a computed property to easily access the user object.
const user = computed(() => page.props.auth.user);

// We determine the user's role and select the correct layout component.
const currentLayout = computed(() => {
    // If the user object is not available, return null to show an empty page or a guest layout.
    // This is a safety check for unauthenticated users.
    if (!user.value) {
        return null;
    }

    // Check the user's 'role' attribute.
    if (user.value.role === 'admin') {
        return LayoutAdmin;
    } else {
        return LayoutClient;
    }
});
</script>

<template>
    <!-- We use the dynamic <component> tag to render the correct layout -->
    <!-- The `<slot>` tag ensures the page content is injected into the layout -->
    <component :is="currentLayout">
        <slot />
    </component>
</template>
    